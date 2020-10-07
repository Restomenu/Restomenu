<?php

namespace App\Http\Controllers\RestaurantAuth;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Library\CommonFunction;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Models\City;
use App\Models\Setting;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRestaurantMailToAdmin;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('restaurant.guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        event(new Registered($user));

        Mail::to(config("restomenu.constants.admin_email"))->send(new NewRestaurantMailToAdmin($user));

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        // dont't remove this
        // return $request->wantsJson()
        //             ? new Response('', 201)
        //             : redirect($this->redirectPath());

        return $request->wantsJson()
            ? new Response('', 201)
            : view('restaurant-new.auth.thank-you');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['restaurant_type_other']) {
            $data['restaurant_type_id'] = null;
        }

        return Validator::make(
            $data,
            [
                'site_name' => ['required', 'string', 'max:191'],
                'phone' => ['required', 'digits:10'],
                'website_url' => ['max:191'],
                'restaurant_type_id' => ['sometimes', 'nullable', 'numeric', 'min:0'],
                'restaurant_type_other' => ['sometimes', 'nullable', 'string', 'max:191'],
                'number_of_employees' => ['required'],
                'first_name' => ['required', 'string', 'max:191'],
                'last_name' => ['required', 'string', 'max:191'],
                'email' => ['required', 'string', 'email', 'max:191', 'unique:restaurants,email,NULL,id,deleted_at,NULL'],
                'street_and_house_number' => ['required', 'string', 'max:191'],
                'city_id' => ['required', 'numeric', 'min:0'],
                'province' => ['required', 'string', 'max:191'],
                'VAT_number' => ['required', 'string', 'max:191'],
                'phone_billing' => ['required', 'digits:10'],
                'email_billing' => ['required', 'string', 'email', 'max:191', 'unique:restaurants,email_billing,NULL,id,deleted_at,NULL'],
            ],
            [
                'site_name.required' => 'This field is required.',
                'site_name.max' => 'Please enter no more than 191 characters.',
                'phone.required' => 'This field is required.',
                'phone.digits' => 'Please enter a valid phone number.',
                'website_url.max' => 'Please enter no more than 191 characters.',
                'restaurant_type_id.required' => 'This field is required.',
                'restaurant_type_id.numeric' => 'This field is invalid.',
                'number_of_employees.required' => 'This field is required.',
                // 'number_of_employees.numeric' => 'This field is invalid.',
                'first_name.required' => 'This field is required.',
                'first_name.max' => 'Please enter no more than 191 characters.',
                'last_name.required' => 'This field is required.',
                'last_name.max' => 'Please enter no more than 191 characters.',
                'email.required' =>  'This field is required.',
                'email.email' => 'This field is invalid.',
                'street_and_house_number.required' =>  'This field is required.',
                'street_and_house_number.max' => 'Please enter no more than 191 characters.',
                'city_id.required' =>  'This field is required.',
                'city_id.numeric' =>  'This field is invalid.',
                'province.required' =>  'This field is required.',
                'province.max' => 'Please enter no more than 191 characters.',
                'VAT_number.required' =>  'This field is required.',
                'VAT_number.max' => 'Please enter no more than 191 characters.',
                'phone_billing.required' => 'This field is required.',
                'phone_billing.digits' => 'Please enter a valid phone number.',

                'email_billing.required' =>  'This field is required.',
                'email_billing.email' => 'This field is invalid.',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Restaurant
     */
    protected function create(array $data)
    {
        $restaurant = new Restaurant();
        $slug = CommonFunction::generateSlug($data['site_name'], $restaurant);

        if ($data['restaurant_type_other']) {
            $data['restaurant_type_id'] = null;
        }

        $restaurant = Restaurant::create([
            'phone' => $data['phone'],
            'slug' => $slug,
            'restaurant_type_id' => $data['restaurant_type_id'],
            'restaurant_type_other' => $data['restaurant_type_other'],
            'number_of_employees' => $data['number_of_employees'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'VAT_number' => $data['VAT_number'],
            'street_and_house_number' => $data['street_and_house_number'],
            'city_id' => $data['city_id'],
            'province' => $data['province'],
            'email' => $data['email'],
            'email_billing' => $data['email_billing'],
            'phone_billing' => $data['phone_billing'],
            'status' => 0
        ]);

        if ($restaurant) {

            $settingInputs = [
                "restaurant_id" => $restaurant->id,
                'site_name' => $data['site_name'],
                'fb_url' => $data['fb_url'],
                'ig_url' => $data['ig_url'],
                'website_url' => $data['website_url'],
                'qr_code_menu' => CommonFunction::generateMenuQrCode($slug, $restaurant->id),
                // "site_logo" => ,
                "available_sms_count" => 0,
                "language_english" => 1,
                "language_dutch" => 1,
                "language_french" => 1,
                "admin_language_english" => 1,
                "admin_language_dutch" => 1,
                "admin_language_french" => 1,
                "defualt_language" => 'en',
                "menu_primary_color" => '#CACC2D',
            ];

            Setting::create($settingInputs);
            return $restaurant;
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // return view('restaurant-new.auth.thank-you');
        $restaurantTypes = RestaurantType::where('status', 1)->pluck('name', 'id');
        $restaurantTypes['0'] = __('Other');
        $cities = City::where('status', 1)->pluck('name', 'id');
        return view('restaurant-new.auth.register', compact('restaurantTypes', 'cities'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('restaurant');
    }
}
