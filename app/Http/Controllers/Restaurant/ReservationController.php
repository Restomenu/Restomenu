<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Visitor;
use App\Models\Setting;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Library\Spryng\Client;
// use SpryngApiHttpPhp\Client;
use SpryngApiHttpPhp\Exception\InvalidRequestException;

class ReservationController extends Controller
{
    public function __construct(Reservation $model,  Setting $settingModel, Notification $notificationModel)
    {
        $this->moduleName = "Reservation";
        $this->moduleRoute = url('reservations');
        $this->moduleView = "restaurant-new.main.reservation";
        $this->model = $model;
        $this->settingModel = $settingModel;
        $this->notificationModel = $notificationModel;

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
        $result = $this->model->where('restaurant_id', $restaurantId);
        // dd($result);
        if ($request->visitorsFilterValue === 'pending') {
            $result = $this->model->where('restaurant_id', $restaurantId)->where('appointment_status', 0);
        } elseif ($request->visitorsFilterValue === 'cancel') {
            $result = $this->model->where('restaurant_id', $restaurantId)->where('appointment_status', -1);
        } elseif ($request->visitorsFilterValue === 'accept') {
            $result = $this->model->where('restaurant_id', $restaurantId)->where('appointment_status', 1);
        } elseif ($request->visitorsFilterValue === 'schedule') {
            $result = $this->model->where('restaurant_id', $restaurantId)->where('appointment_status', 2);
        } elseif ($request->visitorsFilterValue === 'all') {
            $result = $this->model->where('restaurant_id', $restaurantId);
        }

        $result->orderBy('created_at', 'DESC');

        // $result->whereDate('checkin_at', Carbon::today());
        // $appointmentTime = Carbon::createFromFormat('H:i', $result->appointment_time)->format('h:i A');
        // $appointmentTime = Carbon::createFromFormat('H:i', $result->appointment_time)->format('h:i A');
        return Datatables::of($result)
            ->editColumn('appointment_date', function ($result) {
                return Carbon::createFromFormat('Y-m-d', $result->appointment_date)->format('d-m-Y');
            })
            // ->editColumn('appointment_time', function ($result) {
            //     return Carbon::createFromFormat('H:i', $result->appointment_time)->format('h:i A');
            // })
            ->filterColumn('appointment_date', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(str_to_date(reservations.appointment_date,'%Y-%m-%d'),'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->addIndexColumn()->make(true);
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
            $inputs['reservation_cancel_reason'] = $request->reservation_cancel_reason ?? null;
            $inputs['reservation_cancel_desc'] = $request->reservation_cancel_desc ?? null;

            if ($appointment_status === 2) {
                $inputs['appointment_scheduled_time'] = $request->appointment_time;
            }
            $isSaved = $result->update($inputs);

            if ($isSaved) {

                $setting = $this->settingModel->where('restaurant_id', $restaurantId)->first();

                // send message to restaurant
                $isSmsEnabled = config("restomenu.sms.is_enabled");
                $smsServiceStatus = $setting->sms_service_status;
                $customerPhoneNumber = $result->phone;
                $availableSmsCount = (int) $setting->available_sms_count;

                if ($isSmsEnabled && $smsServiceStatus && $availableSmsCount && $availableSmsCount > 0 && $customerPhoneNumber) {
                    $spryngUsername = config("restomenu.sms.username");
                    $spryngPassword = config("restomenu.sms.password");
                    $spryngCompany = config("restomenu.sms.company");

                    $appointmentDate = Carbon::createFromFormat('Y-m-d', $result->appointment_date)->format('d-m-Y');
                    $appointmentTime = Carbon::createFromFormat('H:i', $result->appointment_time)->format('h:i A');

                    if ($appointment_status === 1) {
                        // $message = "Your appointment has been accepted by $restaurant->name.";

                        if ($result->locale == 'en') {
                            $message = "Hello $result->first_name, \nThank you for your reservation, this has been confirmed. Your reservation has been made for $appointmentTime at $appointmentDate. \nSee you soon, \n$restaurant->name";
                        } elseif ($result->locale == 'fr') {
                            $message = "Bonjour $result->first_name, \nMerci pour votre réservation. Nous confirmons avec plaisir qu’une table pour $result->number_of_people personnes vous est réservée le $appointmentDate à $appointmentTime. \n\nA très bientôt ! \n$restaurant->name";
                        } elseif ($result->locale == 'nl') {
                            $message = "Dag $result->first_name, \nBedankt voor je reservatie, deze staat correct ingeboekt om $appointmentTime op $appointmentDate. Aantal personen Tot snel \n$restaurant->name";
                        }
                    } elseif ($appointment_status === -1) {

                        if ($request->reservation_cancel_desc) {
                            $message = $request->reservation_cancel_desc;
                        } else {
                            $message = "Your appointment has been canceled by $restaurant->name.";
                        }

                        // if ($request->reservation_cancel_reason == 1) {

                        //     if ($result->locale == 'en') {
                        //         $message = "Hello $result->first_name, \nWe’re not able to confirm your reservation for $result->number_of_people persons on $appointmentDate at $appointmentTime : We’re already fully booked. \n\nOur sincere apologies, \nKind regards, \n$restaurant->name";
                        //     } elseif ($result->locale == 'nl') {
                        //         $message = "Dag $result->first_name, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor $result->number_of_people personen op $appointmentDate om $appointmentTime : wij zijn reeds volzet vandaag. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n$restaurant->name";
                        //     } elseif ($result->locale == 'fr') {
                        //         $message = "Bonjour $result->first_name, \nNous ne pouvons malheureusement pas confirmer votre réservation pour $result->number_of_people personnes le $appointmentDate à $appointmentTime : nous sommes déjà complet aujourd’hui. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n$restaurant->name";
                        //     }
                        // } elseif ($request->reservation_cancel_reason == 2) {

                        //     if ($result->locale == 'en') {
                        //         $message = "Hello $result->first_name, \nWe’re not able to confirm your reservation for $result->number_of_people persons on $appointmentDate at $appointmentTime : We’re already fully booked on the given day. \n\nOur sincere apologies, \nKind regards, \n$restaurant->name";
                        //     } elseif ($result->locale == 'nl') {
                        //         $message = "Dag $result->first_name, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor $result->number_of_people personen op $appointmentDate om $appointmentTime : Wij zijn reeds volzet die dag. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n$restaurant->name";
                        //     } elseif ($result->locale == 'fr') {
                        //         $message = "Bonjour $result->first_name, \nNous ne pouvons malheureusement pas confirmer votre réservation pour $result->number_of_people personnes le $appointmentDate à $appointmentTime : nous sommes déjà complet ce jour-là. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n$restaurant->name";
                        //     }
                        // } elseif ($request->reservation_cancel_reason == 3) {
                        //     if ($result->locale == 'en') {
                        //         $message = "Hello $result->first_name, \nWe’re not able to confirm your reservation for $result->number_of_people persons on $appointmentDate at $appointmentTime : We’re exceptionally closed today. \n\nOur sincere apologies, \nKind regards, \n$restaurant->name";
                        //     } elseif ($result->locale == 'nl') {
                        //         $message = "Dag $result->first_name, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor $result->number_of_people personen op $appointmentDate om $appointmentTime : Wij zijn vandaag exceptioneel gesloten. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n$restaurant->name";
                        //     } elseif ($result->locale == 'fr') {
                        //         $message = "Bonjour $result->first_name, \nNous ne pouvons malheureusement pas confirmer votre réservation pour $result->number_of_people personnes le $appointmentDate à $appointmentTime : nous sommes exceptionnellement fermé aujourd’hui. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n$restaurant->name";
                        //     }
                        // } elseif ($request->reservation_cancel_reason == 4) {
                        //     if ($result->locale == 'en') {
                        //         $message = "Hello $result->first_name, \nWe’re not able to confirm your reservation for $result->number_of_people persons on $appointmentDate at $appointmentTime : We’re exceptionally closed on the given date. \n\nOur sincere apologies, \nKind regards, \n$restaurant->name";
                        //     } elseif ($result->locale == 'nl') {
                        //         $message = "Dag $result->first_name, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor $result->number_of_people personen op $appointmentDate om $appointmentTime : Wij zijn uitzonderlijk gesloten op $appointmentDate. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n$restaurant->name";
                        //     } elseif ($result->locale == 'fr') {
                        //         $message = "Bonjour $result->first_name, \nNous ne pouvons malheureusement pas confirmer votre réservation pour $result->number_of_people personnes le $appointmentDate à $appointmentTime : nous sommes exceptionnellement fermé ce jour-là. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n$restaurant->name";
                        //     }
                        // } elseif ($request->reservation_cancel_reason == 5) {
                        //     if ($result->locale == 'en') {
                        //         $message = "Hello $result->first_name, \nWe’re already fully booked on $appointmentDate at $appointmentTime. Although, we could propose other time for $result->number_of_people persons. If this hour fits your schedule, could you perhaps call us ($restaurant->phone) as soon as possible to confirm the reservation. \n\nThanks in advance,\n$restaurant->name";
                        //     } elseif ($result->locale == 'nl') {
                        //         $message = "Dag $result->first_name, \nWij zijn reeds vol geboekt op $appointmentDate om $appointmentTime. Wij kunnen jou wel een tafel voor $result->number_of_people personen voorstellen om other time.Als dit uur jou ook past, kun je ons zo snel mogelijk opbellen en bevestigen op $restaurant->phone. \n\nBedankt op voorhand, \n$restaurant->name";
                        //     } elseif ($result->locale == 'fr') {
                        //         $message = "Bonjour $result->first_name, \nNous sommes déjà complet le $appointmentDate à $appointmentTime. mais pouvons vous proposer une table pour $result->number_of_people personnes à other time. Si cette heure vous convient, veuillez nous contacter au plus vite au $restaurant->phone. \n\nD’avance merci,\n$restaurant->name";
                        //     }
                        // } elseif ($request->reservation_cancel_reason == 6) {
                        //     // Others
                        // } else {
                        //     $message = "Your appointment has been canceled by $restaurant->name.";
                        // }
                    } elseif ($appointment_status === 0) {
                        $message = "Your appointment status has been changed to pending by $restaurant->name.";
                    } elseif ($appointment_status === 2) {
                        // $message = "Your appointment has been scheduled by $restaurant->name.";
                        // if ($request->appointment_time) {
                        //     $message .= " On " . $request->appointment_time;
                        // }

                        if ($result->locale == 'en') {
                            $message = "Hello $result->first_name, \nWe’re already fully booked on $appointmentDate at $appointmentTime. Although, we could propose $request->appointment_time for $result->number_of_people persons. If this hour fits your schedule, could you perhaps call us ($restaurant->phone) as soon as possible to confirm the reservation. \n\nThanks in advance,\n$restaurant->name";
                        } elseif ($result->locale == 'nl') {
                            $message = "Dag $result->first_name, \nWij zijn reeds vol geboekt op $appointmentDate om $appointmentTime. Wij kunnen jou wel een tafel voor $result->number_of_people personen voorstellen om $request->appointment_time.Als dit uur jou ook past, kun je ons zo snel mogelijk opbellen en bevestigen op $restaurant->phone. \n\nBedankt op voorhand, \n$restaurant->name";
                        } elseif ($result->locale == 'fr') {
                            $message = "Bonjour $result->first_name, \nNous sommes déjà complet le $appointmentDate à $appointmentTime. mais pouvons vous proposer une table pour $result->number_of_people personnes à $request->appointment_time. Si cette heure vous convient, veuillez nous contacter au plus vite au $restaurant->phone. \n\nD’avance merci,\n$restaurant->name";
                        }
                    }

                    $spryng = new Client($spryngUsername, $spryngPassword, $spryngCompany);
                    // $balance = $spryng->sms->checkBalance();

                    try {
                        // TODO:uncomment
                        $customerSmsResponse = $spryng->sms->send($customerPhoneNumber, $message, [
                            'route' => 'business',
                            'allowlong' => true,
                        ]);

                        Log::info($customerSmsResponse);

                        $setting->available_sms_count = $availableSmsCount - 1;
                        $setting->save();
                    } catch (InvalidRequestException $e) {
                        Log::info($e->getMessage());
                    }
                }

                $viewData = [
                    'message' => __('Status changed successfully.'),
                ];

                $notification = $this->notificationModel->where('reservation_id', $request->visitor_id)->first();

                if ($notification && !$notification->is_read) {
                    $isNotificationUpdate = $notification->update(['is_read' => '1']);
                    if ($isNotificationUpdate) {
                        $viewData['notification_id'] = $notification->id;
                    }
                }

                return response()->json($viewData);
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
