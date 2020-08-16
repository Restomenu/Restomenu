<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use App\Models\ComboDish;
use App\Models\User;
// use App\Repositories\AppSettingsRepository;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

use App;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // AppSettingsRepository $appSettingsRepository
    public function __construct(Setting $settingModel)
    {
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
            'totalUsers' => $this->totalUsers(),
            'totalCustomers' => $this->totalCustomers(),
            'checkedOutCustomers' => $this->checkedOutCustomers(),
        ];

        return view('restaurant-new.main.dashboard.index', compact('dashboardData'));
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function totalCategories()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $totalCategories = Category::where('status', '1')->where('restaurant_id', $restaurantId)->count();
        return $totalCategories;
    }

    public function totalDishes()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $totalDishes = Dish::where('status', '1')->where('restaurant_id', $restaurantId)->count();
        return $totalDishes;
    }

    public function totalComboDishes()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $totalComboDishes = ComboDish::where('status', '1')->where('restaurant_id', $restaurantId)->count();
        return $totalComboDishes;
    }

    public function totalUsers()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $totalUsers = User::where('restaurant_id', $restaurantId)->count();
        return $totalUsers;
    }

    public function totalCustomers()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $totalCustomers = Visitor::where('restaurant_id', $restaurantId)->whereDate('checkin_at', Carbon::today())->count();
        return $totalCustomers;
    }

    public function checkedOutCustomers()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $checkedOutCustomers = Visitor::where('restaurant_id', $restaurantId)->whereNotNull('checkout_at')->whereDate('checkin_at', Carbon::today())->count();

        return $checkedOutCustomers;
    }
}
