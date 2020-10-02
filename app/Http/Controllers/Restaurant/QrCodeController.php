<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\RestaurantRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class QrCodeController extends Controller
{
    public function __construct(Setting $model, RestaurantRepository $restaurantRepository)
    {
        $this->moduleName = "Qr Code";
        $this->moduleRoute = url('qr-code');
        $this->moduleView = "restaurant-new.main.qr_code";
        $this->model = $model;
        $this->restaurantRepository = $restaurantRepository;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
    }

    public function index()
    {
        return view("$this->moduleView.index");
    }

    public function download()
    {
        $restaurant = auth()->guard('restaurant')->user();

        $qrCodePath = config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $restaurant->id . '/' . config("restomenu.path.storage_qr_code") . $restaurant->setting->qr_code_menu;

        return Storage::download($qrCodePath);
    }

    public function print()
    {
        return view("$this->moduleView.print");
    }
}
