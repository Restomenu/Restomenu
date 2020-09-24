<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Repositories\RestaurantRepository;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Library\Spryng\Client;
use App\Library\CommonFunction;
// use SpryngApiHttpPhp\Client;
use SpryngApiHttpPhp\Exception\InvalidRequestException;
use App\Models\Notification;
use App;

class ReservationController extends Controller
{
    public function __construct(Reservation $model, RestaurantRepository $restaurantRepository, Setting $settingModel, Notification $notificationModel)
    {
        $this->model = $model;
        $this->settingModel = $settingModel;
        $this->restaurantRepository = $restaurantRepository;
        $this->notificationModel = $notificationModel;

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
        $this->validate($request, [
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'adults' => 'required',
            'number_of_people' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'is_terms_checked' => 'required',
            'have_covid' => 'required'
        ]);

        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);

        if ($request->appointment_time && $request->appointment_date) {
            // $appointmentTime = Carbon::createFromFormat('h:i A', $request->appointment_time)->toDateTimeString();

            // $day = Carbon::parse($request->appointment_date)->format('l');

            // switch ($day) {
            //     case 'Sunday':
            //         $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_mrng_start_time)->toDateTimeString();

            //         $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_mrng_ending_time)->toDateTimeString();

            //         $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_evng_start_time)->toDateTimeString();

            //         $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_evng_ending_time)->toDateTimeString();
            //         break;
            //     case 'Monday':
            //         $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_mrng_start_time)->toDateTimeString();

            //         $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_mrng_ending_time)->toDateTimeString();

            //         $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_evng_start_time)->toDateTimeString();

            //         $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_evng_ending_time)->toDateTimeString();
            //         break;
            //     case 'Tuesday':
            //         $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_mrng_start_time)->toDateTimeString();

            //         $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_mrng_ending_time)->toDateTimeString();

            //         $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_evng_start_time)->toDateTimeString();

            //         $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_evng_ending_time)->toDateTimeString();
            //         break;
            //     case 'Wednesday':
            //         $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_mrng_start_time)->toDateTimeString();

            //         $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_mrng_ending_time)->toDateTimeString();

            //         $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_evng_start_time)->toDateTimeString();

            //         $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_evng_ending_time)->toDateTimeString();
            //         break;
            //     case 'Thursday':
            //         $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_mrng_start_time)->toDateTimeString();

            //         $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_mrng_ending_time)->toDateTimeString();

            //         $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_evng_start_time)->toDateTimeString();

            //         $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_evng_ending_time)->toDateTimeString();
            //         break;
            //     case 'Friday':
            //         $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_mrng_start_time)->toDateTimeString();

            //         $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_mrng_ending_time)->toDateTimeString();

            //         $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_evng_start_time)->toDateTimeString();

            //         $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_evng_ending_time)->toDateTimeString();
            //         break;
            //     case 'Saturday':
            //         $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_mrng_start_time)->toDateTimeString();

            //         $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_mrng_ending_time)->toDateTimeString();

            //         $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_evng_start_time)->toDateTimeString();

            //         $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_evng_ending_time)->toDateTimeString();
            //         break;
            //     default:
            //         break;
            // }

            // dd(($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time) || ($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time));

            // dd($morning_start_time <= $appointmentTime,$appointmentTime <= $morning_end_time);
            // if (($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time) || ($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time)) {

            $setting = $this->settingModel->where('restaurant_id', $restaurant->id)->first();

            try {

                $inputs = $request->except('_token');
                $inputs['restaurant_id'] = $restaurant->id;
                $inputs['appointment_date'] = Carbon::createFromFormat('d-m-Y', $request->appointment_date)->format('Y-m-d');
                // $inputs['appointment_time'] = Carbon::createFromFormat('h:i A', $request->appointment_time)->format('H:i');

                // add prefix to phone number
                if (isset($request->phone) && $request->phone) {
                    $customerPhoneNumber = CommonFunction::formatPhoneNumber($request->phone);
                    $inputs['phone'] = $customerPhoneNumber;
                }

                $reservation = $this->model->create($inputs);

                if ($reservation) {

                    // send message to restaurant
                    $isSmsEnabled = config("restomenu.sms.is_enabled");
                    $smsServiceStatus = $setting->sms_service_status;
                    $restaurantPhoneNumber = $restaurant->phone;
                    $availableSmsCount = (int) $setting->available_sms_count;

                    if ($isSmsEnabled && $smsServiceStatus && $availableSmsCount && $availableSmsCount > 0 && $restaurantPhoneNumber) {

                        $spryngUsername = config("restomenu.sms.username");
                        $spryngPassword = config("restomenu.sms.password");
                        $spryngCompany = config("restomenu.sms.company");
                        $RestaurantBackendLink = config("restomenu.urls.restaurant_backend_url");

                        if ($restaurant->setting->defualt_language == 'fr') {
                            $messageToRestaurant = "Vous avez une nouvelle réservation en attente de confirmation : $request->number_of_people personnes le $request->appointment_date à $request->appointment_time au nom de $request->last_name $request->first_name. $RestaurantBackendLink";
                        } else if ($restaurant->setting->defualt_language == 'nl') {
                            $messageToRestaurant = "Je hebt een nieuwe reservatie dat wacht op bevestiging: $request->number_of_people personen op $request->appointment_date om $request->appointment_time opnaam van $request->last_name $request->first_name. $RestaurantBackendLink";
                        } else {
                            $messageToRestaurant = "You have a new reservation that is pending your confirmation $request->number_of_people persons reserved on the name $request->last_name $request->first_name on $request->appointment_date at $request->appointment_time. $RestaurantBackendLink";
                        }

                        if ($request->locale == 'fr') {
                            $messageToCustomer = "Votre demande de réservation chez $restaurant->name le $request->appointment_date à $request->appointment_time. à bien été enregistrée. Vous recevrez un sms de confirmation endéans les 30 minutes. Si vous n’avez pas de nos nouvelles au-delà de ce délai, n’hésitez pas à nous contacter au $restaurantPhoneNumber.\nA très bientôt, \nL’équipe $restaurant->name";
                        } else if ($request->locale == 'fr') {
                            $messageToCustomer = "Je reservatie werd aangevraagd bij $restaurant->name op $request->appointment_date om $request->appointment_time. Je zult binnen de 30 minuten een bevestiging sms ontvangen. \nIndien je deze niet binnen de 30 minuten ontvangt, gelieve ons te bellen op $restaurantPhoneNumber om jouw reservering te bevestigen. \nTot snel! \n$restaurant->name team";
                        } else {
                            $messageToCustomer = "Your reservation has been made @ $restaurant->name on $request->appointment_date at $request->appointment_time. You will receive another text message confirming your reservation within 30 minutes. \nIf you don't receive a text message within 30 minutes please call us on $restaurantPhoneNumber to confirm your reservation. \nSee you soon! \n$restaurant->name team";
                        }

                        $spryng = new Client($spryngUsername, $spryngPassword, $spryngCompany);
                        // $balance = $spryng->sms->checkBalance();

                        try {
                            $restaurantSmsResponse = $spryng->sms->send($restaurantPhoneNumber, $messageToRestaurant, [
                                'route' => 'business',
                                'allowlong' => true,
                            ]);

                            Log::info($restaurantSmsResponse);

                            $customerSmsResponse = $spryng->sms->send($customerPhoneNumber, $messageToCustomer, [
                                'route' => 'business',
                                'allowlong' => true,
                            ]);

                            Log::info($customerSmsResponse);

                            $setting->available_sms_count = $availableSmsCount - 2;
                            $setting->save();
                        } catch (InvalidRequestException $e) {
                            Log::info($e->getMessage());
                        }
                    }

                    $reservation['appointment_date_formatted'] = Carbon::createFromFormat('Y-m-d', $reservation->appointment_date)->format('d-m-Y');

                    $notification = $this->notificationModel->create([
                        'restaurant_id' =>  $restaurant->id,
                        'reservation_id' =>  $reservation->id,
                        'notifcation_type' =>  'new_reservation',
                        'notification_data' =>  json_encode($reservation),
                    ]);

                    event(new \App\Events\ReservationEvent($restaurant, $reservation, $notification));
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
            // } else {
            //     $data = [
            //         'message' => __('Please select another time.'),
            //     ];
            //     return response()->json($data, $this->statusCodes['formValidation']);
            // }
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

            $appointmentTime = Carbon::createFromFormat('H:i', $request->appointment_time)->toDateTimeString();
            // $appointmentTime = Carbon::createFromFormat('h:i A', $request->appointment_time)->toDateTimeString();

            $day = Carbon::parse($request->appointment_date)->format('l');

            $openInMorning = false;
            $openInEvening = false;

            switch ($day) {
                case 'Sunday':

                    if (!$restaurant->restaurantTime->sunday_mrng && !$restaurant->restaurantTime->sunday_evng) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    if ($restaurant->restaurantTime->sunday_mrng) {
                        $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_mrng_start_time)->toDateTimeString();

                        $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_mrng_ending_time)->toDateTimeString();

                        $openInMorning = true;
                    }

                    if ($restaurant->restaurantTime->sunday_evng) {
                        $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_evng_start_time)->toDateTimeString();

                        $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->sunday_evng_ending_time)->toDateTimeString();

                        $openInEvening = true;
                    }

                    break;
                case 'Monday':

                    if (!$restaurant->restaurantTime->monday_mrng && !$restaurant->restaurantTime->monday_evng) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    if ($restaurant->restaurantTime->monday_mrng) {
                        $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_mrng_start_time)->toDateTimeString();

                        $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_mrng_ending_time)->toDateTimeString();

                        $openInMorning = true;
                    }

                    if ($restaurant->restaurantTime->monday_evng) {
                        $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_evng_start_time)->toDateTimeString();

                        $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->monday_evng_ending_time)->toDateTimeString();

                        $openInEvening = true;
                    }
                    break;
                case 'Tuesday':

                    if (!$restaurant->restaurantTime->tuesday_mrng && !$restaurant->restaurantTime->tuesday_evng) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    if ($restaurant->restaurantTime->tuesday_mrng) {
                        $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_mrng_start_time)->toDateTimeString();

                        $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_mrng_ending_time)->toDateTimeString();

                        $openInMorning = true;
                    }

                    if ($restaurant->restaurantTime->tuesday_evng) {
                        $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_evng_start_time)->toDateTimeString();

                        $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->tuesday_evng_ending_time)->toDateTimeString();

                        $openInEvening = true;
                    }
                    break;
                case 'Wednesday':

                    if (!$restaurant->restaurantTime->wednesday_mrng && !$restaurant->restaurantTime->wednesday_evng) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    if ($restaurant->restaurantTime->wednesday_mrng) {
                        $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_mrng_start_time)->toDateTimeString();

                        $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_mrng_ending_time)->toDateTimeString();

                        $openInMorning = true;
                    }
                    if ($restaurant->restaurantTime->wednesday_evng) {

                        $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_evng_start_time)->toDateTimeString();

                        $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->wednesday_evng_ending_time)->toDateTimeString();

                        $openInEvening = true;
                    }
                    break;
                case 'Thursday':

                    if (!$restaurant->restaurantTime->thursday_mrng && !$restaurant->restaurantTime->thursday_evng) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    if ($restaurant->restaurantTime->thursday_mrng) {
                        $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_mrng_start_time)->toDateTimeString();

                        $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_mrng_ending_time)->toDateTimeString();
                        $openInMorning = true;
                    }
                    if ($restaurant->restaurantTime->thursday_evng) {
                        $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_evng_start_time)->toDateTimeString();

                        $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->thursday_evng_ending_time)->toDateTimeString();
                        $openInEvening = true;
                    }
                    break;
                case 'Friday':

                    if (!$restaurant->restaurantTime->friday_mrng  && !$restaurant->restaurantTime->friday_evng) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    if ($restaurant->restaurantTime->friday_mrng) {
                        $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_mrng_start_time)->toDateTimeString();

                        $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_mrng_ending_time)->toDateTimeString();
                        $openInMorning = true;
                    }

                    if ($restaurant->restaurantTime->friday_evng) {
                        $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_evng_start_time)->toDateTimeString();

                        $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->friday_evng_ending_time)->toDateTimeString();
                        $openInEvening = true;
                    }
                    break;
                case 'Saturday':

                    if (!$restaurant->restaurantTime->saturday_mrng && !$restaurant->restaurantTime->saturday_evng) {
                        $data = [
                            'message' => __('Restaurant will be closed on your selected date.'),
                        ];
                        return response()->json($data, $this->statusCodes['serverSide']);
                    }

                    if ($restaurant->restaurantTime->saturday_mrng) {
                        $morning_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_mrng_start_time)->toDateTimeString();

                        $morning_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_mrng_ending_time)->toDateTimeString();
                        $openInMorning = true;
                    }
                    if ($restaurant->restaurantTime->saturday_evng) {
                        $evening_start_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_evng_start_time)->toDateTimeString();

                        $evening_end_time = Carbon::createFromFormat('H:i', $restaurant->restaurantTime->saturday_evng_ending_time)->toDateTimeString();
                        $openInEvening = true;
                    }
                    break;
                default:
                    break;
            }

            if ($openInMorning && $openInEvening) {
                if (($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time) || ($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time)) {
                    return 'true';
                }
            } elseif ($openInMorning) {
                if (($morning_start_time <= $appointmentTime) && ($appointmentTime <= $morning_end_time)) {
                    return 'true';
                }
            } elseif ($openInEvening) {
                if (($evening_start_time <= $appointmentTime) && ($appointmentTime <= $evening_end_time)) {
                    return 'true';
                }
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
