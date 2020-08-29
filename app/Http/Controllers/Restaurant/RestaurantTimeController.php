<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Models\RestaurantTime;
use Illuminate\Support\Facades\View;

class RestaurantTimeController extends Controller
{
    public function __construct(RestaurantTime $model)
    {
        $this->moduleName = "Restaurant Timings";
        // $this->moduleRoute = url('settings');
        $this->moduleView = "restaurant-new.main.restaurant-time";
        $this->model = $model;

        View::share('module_name', $this->moduleName);
        // View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);

        $this->statusCodes = config("restomenu.responseCodes");
    }

    public function edit()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $restaurantTime = $this->model->where('restaurant_id', $restaurantId)->first();
        return view($this->moduleView . ".index", compact("restaurantTime"));
    }

    public function update(Request $request)
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $result = $this->model->where('restaurant_id', $restaurantId)->first();

        try {
            $inputs = $request->except(['_token']);
            if ($result) {
                $response = $result->update($inputs);
                if ($response) {
                    return redirect(route('restaurant.home'))->with("success", __("Restaurant time updated!"));
                }
                return redirect(route('restaurant.restaurant-time-edit'))->with("error", __("Something went wrong, please try again later."));
            } else {
                $inputs['restaurant_id'] = $restaurantId;
                $isSaved = $this->model->create($inputs);
                if ($isSaved) {
                    return redirect(route('restaurant.home'))->with("success", __("Restaurant time updated!"));
                }
                return redirect(route('restaurant.restaurant-time-edit'))->with("error", __("Something went wrong, please try again later."));
            }
        } catch (\Exception $e) {
            return redirect(route('restaurant.restaurant-time-edit'))->with('error', $e->getMessage());
        }
    }
}
