<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Repositories\RestaurantRepository;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use SpryngApiHttpPhp\Client;
use SpryngApiHttpPhp\Exception\InvalidRequestException;
use App;

class ReservationController extends Controller
{
    public function __construct(Reservation $model, RestaurantRepository $restaurantRepository, Setting $settingModel)
    {
        $this->model = $model;
        $this->settingModel = $settingModel;
        $this->restaurantRepository = $restaurantRepository;

        $this->statusCodes = config("restomenu.responseCodes");
    }

    public function index($slug)
    {
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);

        $totalAvailableLanguage = $restaurant->setting->language_english + $restaurant->setting->language_dutch + $restaurant->setting->language_french;

        if ($totalAvailableLanguage > 1) {
            return $this->selectLanguage($restaurant);
        }

        if ($restaurant->setting->language_dutch) {
            return $this->reservationIndex($slug, 'nl');
        }

        if ($restaurant->setting->language_french) {
            return $this->reservationIndex($slug, 'fr');
        }

        if ($restaurant->setting->language_english) {
            return $this->reservationIndex($slug, 'en');
        }
    }

    public function selectLanguage($restaurant)
    {
        return view("reservation.select-language.index")->with('restaurant', $restaurant);
    }

    public function reservationIndex($slug, $locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);

        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);
        return view("reservation.table-reservation.index")->with('restaurant', $restaurant)->with('locale', $locale);
    }

    public function store(Request $request, $slug)
    {
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);

        if ($request->appointment_time && $request->appointment_date) {
            $appointmentTime = Carbon::createFromFormat('h:i A', $request->appointment_time)->toDateTimeString();

            $day = Carbon::parse($request->appointment_date)->format('l');

            switch ($day) {
                case 'Sunday':
                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Monday':
                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Tuesday':
                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Wednesday':
                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Thursday':
                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Friday':
                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Saturday':
                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_evng_ending_time)->toDateTimeString();
                    break;
                default:
                    break;
            }

            // dd(($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time) || ($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time));

            // dd($morning_start_time <= $appointmentTime,$appointmentTime <= $morning_end_time);
            if (($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time) || ($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time)) {

                $setting = $this->settingModel->where('restaurant_id', $restaurant->id)->first();

                try {

                    $inputs = $request->except('_token');
                    $inputs['restaurant_id'] = $restaurant->id;
                    $inputs['appointment_date'] = Carbon::createFromFormat('d-m-Y', $request->appointment_date)->format('Y-m-d');
                    $inputs['appointment_time'] = Carbon::createFromFormat('h:i A', $request->appointment_time)->format('H:i');

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
                        event(new \App\Events\ReservationEvent());
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
        } else {
            $setting = $this->settingModel->where('restaurant_id', $restaurant->id)->first();

            try {

                $inputs = $request->except('_token');
                $inputs['restaurant_id'] = $restaurant->id;

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
        }
    }

    public function timeCheck(Request $request, $slug)
    {
        if ($request->appointment_time && $request->appointment_date) {
            $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);

            $appointmentTime = Carbon::createFromFormat('h:i A', $request->appointment_time)->toDateTimeString();

            $day = Carbon::parse($request->appointment_date)->format('l');

            switch ($day) {
                case 'Sunday':

                    if (!$restaurant->restaurantTime->sunday) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Monday':

                    if (!$restaurant->restaurantTime->monday) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Tuesday':

                    if (!$restaurant->restaurantTime->tuesday) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Wednesday':

                    if (!$restaurant->restaurantTime->wednesday) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Thursday':

                    if (!$restaurant->restaurantTime->thursday) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Friday':

                    if (!$restaurant->restaurantTime->friday) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_evng_ending_time)->toDateTimeString();
                    break;
                case 'Saturday':

                    if (!$restaurant->restaurantTime->saturday) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_mrng_start_time)->toDateTimeString();

                    $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_mrng_ending_time)->toDateTimeString();

                    $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_evng_start_time)->toDateTimeString();

                    $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_evng_ending_time)->toDateTimeString();
                    break;
                default:
                    break;
            }

            if (($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time) || ($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time)) {
                return 'true';
            }
            $data = [
                'message' => __('Please select another date or time.'),
            ];
            return response()->json($data, $this->statusCodes['serverSide']);
        } else {
            $data = [
                'message' => __('Please select reservation date and time.'),
            ];
            return response()->json($data, $this->statusCodes['serverSide']);
        }
    }
}
