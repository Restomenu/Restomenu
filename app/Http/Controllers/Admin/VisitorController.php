<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function __construct(Visitor $model)
    {
        $this->moduleName = "Customer";
        $this->moduleRoute = url('visitors');
        $this->moduleView = "admin.main.visitors";
        $this->model = $model;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
    }

    public function index()
    {
        return view("$this->moduleView.index");
    }

    public function getDatatable()
    {
        $result = $this->model->leftjoin('restaurants', 'restaurants.id', '=', 'visitors.restaurant_id')->select("visitors.*", "restaurants.name as restaurant_name")->orderBy('checkin_at', 'desc')->get();

        return Datatables::of($result)->addIndexColumn()->make(true);
    }
}
