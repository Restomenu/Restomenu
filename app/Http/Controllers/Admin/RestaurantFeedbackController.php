<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantFeedback;
use Illuminate\Support\Facades\View;
use App\Models\Visitor;
use Yajra\Datatables\Datatables;

class RestaurantFeedbackController extends Controller
{
    public function __construct(RestaurantFeedback $model)
    {
        $this->moduleName = "Feedback";
        $this->moduleRoute = url('restaurant-feedbacks');
        $this->moduleView = "admin.main.restaurant-feedbacks";
        $this->model = $model;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
        $this->statusCodes = config("restomenu.responseCodes");
    }

    public function index()
    {
        return view("$this->moduleView.index");
    }

    public function getDatatable()
    {
        $result = $this->model->leftjoin('restaurants', 'restaurants.id', '=', 'restaurant_feedbacks.restaurant_id')->select("restaurant_feedbacks.*", "settings.site_name as restaurant_name")->leftjoin('settings', 'settings.restaurant_id', '=', 'restaurants.id')->orderBy('id', 'desc');

        return Datatables::of($result)->addIndexColumn()->make(true);
    }
}
