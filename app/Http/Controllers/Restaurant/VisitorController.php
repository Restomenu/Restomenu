<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SpryngApiHttpPhp\Client;
use SpryngApiHttpPhp\Exception\InvalidRequestException;

class VisitorController extends Controller
{
    public function __construct(Visitor $model,  Setting $settingModel)
    {
        $this->moduleName = "Customer";
        $this->moduleRoute = url('visitors');
        $this->moduleView = "restaurant-new.main.visitors";
        $this->model = $model;
        $this->settingModel = $settingModel;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);

        $this->statusCodes = config("restomenu.responseCodes");
    }

    public function index()
    {
        return view("$this->moduleView.index");
    }

    public function getDatatable(Request $request)
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $result = $this->model->where('restaurant_id', $restaurantId)->orderBy('checkin_at', 'asc')->whereNull('checkout_at');

        if ($request->visitorsFilterValue === 'all') {
            $result = $this->model->where('restaurant_id', $restaurantId)->orderBy('checkin_at', 'desc');
        } elseif ($request->visitorsFilterValue === 'checkIn') {
            $result = $this->model->where('restaurant_id', $restaurantId)->orderBy('checkin_at', 'asc')->whereNull('checkout_at');
        } elseif ($request->visitorsFilterValue === 'checkOut') {
            $result = $this->model->where('restaurant_id', $restaurantId)->orderBy('checkin_at', 'desc')->whereNotNull('checkout_at');
        }

        $result->whereDate('checkin_at', Carbon::today());

        return Datatables::of($result)->addIndexColumn()->make(true);
    }

    public function editCheckout($id)
    {
        try {
            $restaurantId = auth()->guard('restaurant')->user()->id;
            $result = $this->model->where('restaurant_id', $restaurantId)->find($id);
            $inputs['checkout_at'] = Carbon::now()->toDateTimeString();
            $isSaved = $result->update($inputs);

            if ($isSaved) {
                return response()->json(['message' => __('Status changed successfully.')]);
            } else {
                $data = [
                    'message' => __("Something went wrong, please try again later.")
                ];
                return response()->json($data, $this->statusCodes['serverSide']);
            }
        } catch (\Exception $e) {
            $data = [
                'message' => $e->getMessage()
            ];
            return response()->json($data, $this->statusCodes['serverSide']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("restaurant-new.main.general.create-simple");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $inputs = $request->except('_token', 'checkin_date', 'checkin_time');
            $inputs['restaurant_id'] = auth()->guard('restaurant')->user()->id;

            if (!$request->checkin_at) {
                $inputs['checkin_at'] = Carbon::now()->toDateTimeString();
            } else {
                $inputs['checkin_at'] = Carbon::createFromFormat('Y-m-d H:i', $request->checkin_at)->format('Y-m-d H:i:s');
            }

            $isSaved = $this->model->create($inputs);

            if ($isSaved) {
                return redirect($this->moduleRoute)->with("success", __($this->moduleName . ' Added Successfully.'));
            }
            return redirect($this->moduleRoute)->with("error", __("Something went wrong, please try again later."));
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function statusUpdate(Request $request)
    {
        try {
            $restaurant = auth()->guard('restaurant')->user();

            $restaurantId = $restaurant->id;

            $result = $this->model->where('restaurant_id', $restaurantId)->find($request->visitor_id);
            $appointment_status = (int) $request->status;
            $inputs['appointment_status'] = $appointment_status;
            $inputs['appointment_time'] = null;

            if ($appointment_status === 2) {
                $inputs['appointment_time'] = $request->appointment_time;
            }
            $isSaved = $result->update($inputs);

            if ($isSaved) {

                $setting = $this->settingModel->where('restaurant_id', $restaurantId)->first();

                // send message to restaurant
                $isSmsEnabled = config("restomenu.sms.is_enabled");
                $smsServiceStatus = $setting->sms_service_status;
                $customerPhoneNumber = $restaurant->phone;
                $availableSmsCount = (int) $setting->available_sms_count;

                if ($isSmsEnabled && $smsServiceStatus && $availableSmsCount && $availableSmsCount > 0 && $customerPhoneNumber) {
                    $spryngUsername = config("restomenu.sms.username");
                    $spryngPassword = config("restomenu.sms.password");
                    $spryngCompany = config("restomenu.sms.company");

                    if ($appointment_status === 1) {
                        $message = "Your appointment has been accepted by $restaurant->name.";
                    } elseif ($appointment_status === -1) {
                        $message = "Your appointment has been canceled by $restaurant->name.";
                    } elseif ($appointment_status === 0) {
                        $message = "Your appointment status has been changed to pending by $restaurant->name.";
                    } elseif ($appointment_status === 2) {
                        $message = "Your appointment has been scheduled by $restaurant->name.";
                        if ($request->appointment_time) {
                            $message .= " On " . $request->appointment_time;
                        }
                    }

                    $spryng = new Client($spryngUsername, $spryngPassword, $spryngCompany);
                    // $balance = $spryng->sms->checkBalance();

                    try {
                        $spryng->sms->send($customerPhoneNumber, $message, [
                            'route' => 'business',
                            'allowlong' => true,
                        ]);

                        $setting->available_sms_count = $availableSmsCount - 1;
                        $setting->save();
                    } catch (InvalidRequestException $e) {
                        Log::info($e->getMessage());
                    }
                }

                return response()->json(['message' => __('Status changed successfully.')]);
            } else {
                $data = [
                    'message' => __("Something went wrong, please try again later.")
                ];
                return response()->json($data, $this->statusCodes['serverSide']);
            }
        } catch (\Exception $e) {
            $data = [
                'message' => $e->getMessage()
            ];
            return response()->json($data, $this->statusCodes['serverSide']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = [];

        try {
            $restaurantId = auth()->guard('restaurant')->user()->id;
            $res = $this->model->where('restaurant_id', $restaurantId)->find($id);
            if ($res) {
                $res->delete();

                $result['message'] = __($this->moduleName . " Deleted Successfully.");
                $result['code'] = 200;
            } else {
                $result['code'] = 400;
                $result['message'] = __("Something went wrong, please try again later.");
            }
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            $result['code'] = 400;
        }

        return response()->json($result, $result['code']);
    }
}
