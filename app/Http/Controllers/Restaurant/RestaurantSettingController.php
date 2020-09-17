<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\RestaurantTime;
use Illuminate\Support\Facades\View;

class RestaurantSettingController extends Controller
{
    public function __construct(RestaurantTime $model, Setting $settingModel)
    {
        $this->moduleName = "My Restaurant Settings";
        // $this->moduleRoute = url('settings');
        $this->moduleView = "restaurant-new.main.restaurant-setting";
        $this->model = $model;
        $this->settingModel = $settingModel;


        View::share('module_name', $this->moduleName);
        // View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);

        $this->statusCodes = config("restomenu.responseCodes");
    }

    public function edit()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $setting = $this->settingModel->where('restaurant_id', $restaurantId)->first();
        $restaurantTime = $this->model->where('restaurant_id', $restaurantId)->first();
        return view($this->moduleView . ".index", compact("restaurantTime","setting"));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $restaurantTimeResult = $this->model->where('restaurant_id', $restaurantId)->first();
        $settingResult = $this->settingModel->where('restaurant_id', $restaurantId)->first();
        

        try {
if(isset($request->email)||isset($request->phone)||isset($request->fb_url)||isset($request->ig_url)||isset($request->tw_url)){

            if (auth()->guard('restaurant')->user()->email != $request->email) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|max:255|unique:restaurants',

                ], [
                    'email.unique' => 'This Email Already Registered',
                    'email.required' => 'Please Email Address',

                ]);

                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator->messages());
                }

                Restaurant::find($restaurantId)->update(['email' => $request->email]);
                
            }

            if (auth()->guard('restaurant')->user()->phone != $request->phone) {


                $validator = Validator::make($request->all(), [
                    'phone' => 'required|numeric|unique:restaurants',

                ], [
                    'phone.unique' => 'This Number Already Registered',
                    'phone.required' => 'Please Enter Number',

                ]);

                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator->messages());
                }

                // $this->validate($request, [
                //     'phone' => 'required|numeric|unique:restaurants',
                // ]);


                Restaurant::find($restaurantId)->update(['phone' => $request->phone]);
            }

            if ($request->old_password) {
                $hashedPassword = Restaurant::find($restaurantId)->password;
                // dd($hashedPassword);
                if (Hash::check($request->old_password, $hashedPassword)) {
                    // $this->validate($request, [
                    //     'password' => 'required|confirmed'
                    // ]);


                    $validator = Validator::make($request->all(), [
                        'password' => 'required',
                        'password_confirmation' => 'same:password',
                    ], [
                        'password_confirmation.same' => 'Confirm password does not match.'
                    ]);

                    if ($validator->fails()) {
                        return back()->withInput()->withErrors($validator->messages());
                    }

                    $newpassword = Hash::make($request->password);



                    Restaurant::find($restaurantId)->update(['password' => $newpassword]);
                } else {
                    return redirect(route('restaurant.restaurant-settings-edit'))->with("error", "Sorry! Your Current Password is Wrong");
                }
            }

            if ($settingResult) {
                $inputs = $request->only(['fb_url','ig_url','tw_url']);
                $settingResultResponse = $settingResult->update($inputs);
                if (!$settingResultResponse) {
                    return redirect(route('restaurant.restaurant-setting-edit'))->with("error", __("Something went wrong, please try again later."));
                }
                
            }  
            
        }else{

            if ($restaurantTimeResult) {
                $inputs = $request->except(['_token']);
                $restaurantTimeResultResponse = $restaurantTimeResult->update($inputs);
                if ($restaurantTimeResultResponse) {
                    return redirect(route('restaurant.restaurant-setting-edit'))->with("success", __("Restaurant time updated!"));
                }
                return redirect(route('restaurant.restaurant-setting-edit'))->with("error", __("Something went wrong, please try again later."));
            } else {
                $inputs['restaurant_id'] = $restaurantId;
                $isSaved = $this->model->create($inputs);
                if ($isSaved) {
                    return redirect(route('restaurant.restaurant-setting-edit'))->with("success", __("Restaurant time updated!"));
                }
                return redirect(route('restaurant.restaurant-setting-edit'))->with("error", __("Something went wrong, please try again later."));
            }
        }          

            return redirect(route('restaurant.restaurant-setting-edit'))->with("success", __("Restaurant Setting updated!"));
        } catch (\Exception $e) {
            return redirect(route('restaurant.restaurant-setting-edit'))->with('error', $e->getMessage());
        }
    }
}
