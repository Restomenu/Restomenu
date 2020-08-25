<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\RestaurantRepository;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use SpryngApiHttpPhp\Client;
use SpryngApiHttpPhp\Exception\InvalidRequestException;

class VisitorController extends Controller
{
    public function __construct(Visitor $model, RestaurantRepository $restaurantRepository, Setting $settingModel)
    {
        $this->model = $model;
        $this->settingModel = $settingModel;
        $this->restaurantRepository = $restaurantRepository;

        $this->statusCodes = config("restomenu.responseCodes");
    }

    public function store(Request $request, $slug)
    {
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);

        // $currentTime = Carbon::now()->toDateTimeString();
        $appointmentTime = Carbon::createFromFormat('H:i', $request->appointment_time)->toDateTimeString();

        $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->morning_start_time)->toDateTimeString();

        $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->morning_end_time)->toDateTimeString();

        $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->evening_start_time)->toDateTimeString();

        $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->evening_end_time)->toDateTimeString();

        // dd(($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time) || ($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time));

        if (($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time) || ($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time)) {

            $setting = $this->settingModel->where('restaurant_id', $restaurant->id)->first();

            try {

                $inputs = $request->except('_token');
                $inputs['restaurant_id'] = $restaurant->id;
                $inputs['checkin_at'] = Carbon::now()->toDateTimeString();

                $isSaved = $this->model->create($inputs);

                if ($isSaved) {

                    // send message to restaurant
                    $isSmsEnabled = config("restomenu.sms.is_enabled");
                    $smsServiceStatus = $setting->sms_service_status;
                    $restaurantPhoneNumber = $restaurant->phone;
                    $availableSmsCount = (int) $setting->available_sms_count;

                    if ($isSmsEnabled && $smsServiceStatus && $availableSmsCount && $availableSmsCount > 0 && $restaurantPhoneNumber) {

                        $spryngUsername = config("restomenu.sms.username");
                        $spryngPassword = config("restomenu.sms.password");
                        $spryngCompany = config("restomenu.sms.company");
                        $message = __("New Customer Registered!");

                        $spryng = new Client($spryngUsername, $spryngPassword, $spryngCompany);
                        // $balance = $spryng->sms->checkBalance();

                        try {
                            $spryng->sms->send($restaurantPhoneNumber, $message, [
                                'route' => 'business',
                                'allowlong' => true,
                            ]);

                            $setting->available_sms_count = $availableSmsCount - 1;
                            $setting->save();
                        } catch (InvalidRequestException $e) {
                            Log::info($e->getMessage());
                        }
                    }

                    $data = [
                        'message' => __('Registration successful.'),
                    ];
                    return response()->json($data, $this->statusCodes['success']);
                }
                return response()->json($data, $this->statusCodes['serverSide']);
            } catch (\Exception $e) {
                $data = [
                    'message' => $e->getMessage()
                ];
                return response()->json($data, $this->statusCodes['serverSide']);
            }
        } else {
            $data = [
                'message' => __('Please select another time.'),
            ];
            return response()->json($data, $this->statusCodes['formValidation']);
        }
    }
}
