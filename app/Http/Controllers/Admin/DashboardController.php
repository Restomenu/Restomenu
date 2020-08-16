<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use App\Models\ComboDish;
use App\Models\User;
use App\Repositories\AppSettingsRepository;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

use App;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct(Setting $settingModel)
    {
        // $this->language = [];
        // $this->language = array(

        //     'isEnglish' => $appSettingsRepository->getSettings()['admin_language_english'],
        //     'isDutch' => $appSettingsRepository->getSettings()['admin_language_dutch'],
        //     'isFrench' => $appSettingsRepository->getSettings()['admin_language_french'],
        // );

        // if (!session()->has('local')) {
        //     session()->put('locale', $appSettingsRepository->getSettings()['defualt_language']);
        // }
    }
    public function index()
    {
        $dashboardData = [
            'totalCategories' => $this->totalCategories(),
            'totalDishes' => $this->totalDishes(),
            'totalComboDishes' => $this->totalComboDishes(),
            'totalCustomers' => $this->totalCustomers()
        ];

        return view('admin.main.dashboard.index', compact('dashboardData'));
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function totalCategories()
    {
        $totalCategories = Category::where('status', '1')->count();
        return $totalCategories;
    }

    public function totalDishes()
    {
        $totalDishes = Dish::where('status', '1')->count();
        return $totalDishes;
    }

    public function totalComboDishes()
    {
        $totalComboDishes = ComboDish::where('status', '1')->count();
        return $totalComboDishes;
    }

    public function totalCustomers()
    {
        $totalUsers = User::count();
        return $totalUsers;
    }
}
