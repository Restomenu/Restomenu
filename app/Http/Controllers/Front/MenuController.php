<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ComboDishCategory;
use App\Models\ComboDish;
use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CategoryRepository;
use App\Repositories\ComboDishRepository;
use App\Repositories\RestaurantRepository;
use App;
use DB;

class MenuController extends Controller
{
    public function __construct(Category $categoryModel, Dish $dishModel, ComboDish $comboDishModel, CategoryRepository $categoryRepository, ComboDishRepository $comboDishRepository, Restaurant $restaurantModel, RestaurantRepository $restaurantRepository)
    {
        $this->moduleName = "Menu";
        $this->moduleRoute = url('menu');
        $this->moduleView = "front.menu";
        $this->categoryModel = $categoryModel;
        $this->dishModel = $dishModel;
        $this->comboDishModel = $comboDishModel;
        $this->restaurantModel = $restaurantModel;

        $this->categoryRepository = $categoryRepository;
        $this->comboDishRepository = $comboDishRepository;
        $this->restaurantRepository = $restaurantRepository;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
    }

    public function order()
    {
        return view("front.menu.order");
    }

    public function bill()
    {
        return view("front.menu.bill");
    }

    public function index($slug)
    {
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);

        $totalAvailableLanguage = $restaurant->setting->language_english + $restaurant->setting->language_dutch + $restaurant->setting->language_french;

        if ($totalAvailableLanguage > 1) {
            return $this->selectLanguage($restaurant);
        }

        if ($restaurant->setting->language_dutch) {
            return $this->menuDutch($slug);
        }

        if ($restaurant->setting->language_french) {
            return $this->menuFrench($slug);
        }

        if ($restaurant->setting->language_english) {
            return $this->menuEnglish($slug);
        }
    }

    public function selectLanguage($restaurant)
    {
        return view("front.select-language.index")->with('restaurant', $restaurant);
    }

    public function menuDutch($slug)
    {
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);
        $result = $this->categoryRepository->getCategoriesForMenu($restaurant->id);

        foreach ($result as $key => $category) {
            $category->name = $category->name_dutch;
            $category->description = $category->description_dutch;

            foreach ($category->dishes as $key => $dish) {
                $dish->name = $dish->name_dutch;
                $dish->description = $dish->description_dutch;
            }
        }

        $comboDishes = $this->comboDishRepository->getAllActive($restaurant->id);

        foreach ($comboDishes as $key => $comboDish) {
            $comboDish->name = $comboDish->name_dutch;
            $comboDish->description = $comboDish->description_dutch;
            $comboDish->sub_title = $comboDish->sub_title_dutch;
        }
        $comboDishesDetails = [];
        foreach ($comboDishes as $key => $comboDish) {

            $comboDishesDetails[trim($comboDish->name)] = $this->comboDishModel::join('combo_dish_categories', 'combo_dish_categories.combo_dish_id', '=', 'combo_dishes.id')
                ->join('categories', 'categories.id', '=', 'combo_dish_categories.category_id')
                ->leftjoin('combo_dish_subcategories', 'combo_dish_subcategories.combo_dish_categories_id', '=', 'combo_dish_categories.id')
                ->where('combo_dishes.status', 1)
                ->where('combo_dish_categories.combo_dish_id', $comboDish->id)
                ->select('combo_dishes.name_dutch AS combo_dish_name', 'combo_dish_categories.dish_quantity', 'combo_dishes.image AS combo_dish_image', 'categories.name_dutch AS category_name', 'combo_dishes.price AS combo_dish_price')
                ->selectRaw('(SELECT GROUP_CONCAT(dishes.name_dutch SEPARATOR "<span> Of </span>") FROM combo_dish_subcategories JOIN dishes ON combo_dish_subcategories.dish_id = dishes.id  WHERE combo_dish_subcategories.combo_dish_categories_id = combo_dish_categories.id )AS dish_name')
                ->groupBy('combo_dish_categories.id')
                ->where('combo_dishes.restaurant_id', $restaurant->id)
                ->get()->toArray();
        }

        $comboDishesDetails = $this->getFormattedComboDishes($comboDishesDetails);

        App::setLocale('nl');
        session()->put('locale', 'nl');

        return view("$this->moduleView.index", compact('result', 'comboDishes', 'comboDishesDetails'))->with('restaurant', $restaurant);
    }

    public function menuFrench($slug)
    {
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);
        $result = $this->categoryRepository->getCategoriesForMenu($restaurant->id);

        foreach ($result as $key => $category) {
            $category->name = $category->name_french;
            $category->description = $category->description_french;

            foreach ($category->dishes as $key => $dish) {
                $dish->name = $dish->name_french;
                $dish->description = $dish->description_french;
            }
        }

        $comboDishes = $this->comboDishRepository->getAllActive($restaurant->id);

        foreach ($comboDishes as $key => $comboDish) {
            $comboDish->name = $comboDish->name_french;
            $comboDish->description = $comboDish->description_french;
            $comboDish->sub_title = $comboDish->sub_title_french;
        }

        $comboDishesDetails = [];

        foreach ($comboDishes as $key => $comboDish) {

            $comboDishesDetails[trim($comboDish->name)] = $this->comboDishModel::join('combo_dish_categories', 'combo_dish_categories.combo_dish_id', '=', 'combo_dishes.id')
                ->join('categories', 'categories.id', '=', 'combo_dish_categories.category_id')
                ->leftjoin('combo_dish_subcategories', 'combo_dish_subcategories.combo_dish_categories_id', '=', 'combo_dish_categories.id')
                ->where('combo_dishes.status', 1)
                ->where('combo_dish_categories.combo_dish_id', $comboDish->id)
                ->select('combo_dishes.name_french AS combo_dish_name', 'combo_dish_categories.dish_quantity', 'combo_dishes.image AS combo_dish_image', 'categories.name_french AS category_name', 'combo_dishes.price AS combo_dish_price')
                ->selectRaw('(SELECT GROUP_CONCAT(dishes.name_french SEPARATOR "<span> Ou </span>") FROM combo_dish_subcategories JOIN dishes ON combo_dish_subcategories.dish_id = dishes.id  WHERE combo_dish_subcategories.combo_dish_categories_id = combo_dish_categories.id )AS dish_name')
                ->groupBy('combo_dish_categories.id')
                ->where('combo_dishes.restaurant_id', $restaurant->id)
                ->get()->toArray();
        }

        $comboDishesDetails = $this->getFormattedComboDishes($comboDishesDetails);

        App::setLocale('fr');
        session()->put('locale', 'fr');

        return view("$this->moduleView.index", compact('result', 'comboDishes', 'comboDishesDetails'))->with('restaurant', $restaurant);
    }

    public function menuEnglish($slug)
    {
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);

        $result = $this->categoryRepository->getCategoriesForMenu($restaurant->id);
        $comboDishes = $this->comboDishRepository->getAllActive($restaurant->id);
        
        $comboDishesDetails = [];

        foreach ($comboDishes as $key => $comboDish) {

            $comboDishesDetails[trim($comboDish->name)] = $this->comboDishModel::join('combo_dish_categories', 'combo_dish_categories.combo_dish_id', '=', 'combo_dishes.id')
                ->join('categories', 'categories.id', '=', 'combo_dish_categories.category_id')
                ->leftjoin('combo_dish_subcategories', 'combo_dish_subcategories.combo_dish_categories_id', '=', 'combo_dish_categories.id')
                ->where('combo_dishes.status', 1)
                ->where('combo_dish_categories.combo_dish_id', $comboDish->id)
                ->select('combo_dishes.name AS combo_dish_name', 'combo_dish_categories.dish_quantity', 'combo_dishes.image AS combo_dish_image', 'categories.name AS category_name', 'combo_dishes.price AS combo_dish_price')
                ->selectRaw('(SELECT GROUP_CONCAT(dishes.name SEPARATOR "<span> OR </span>") FROM combo_dish_subcategories JOIN dishes ON combo_dish_subcategories.dish_id = dishes.id  WHERE combo_dish_subcategories.combo_dish_categories_id = combo_dish_categories.id )AS dish_name')
                ->groupBy('combo_dish_categories.id')
                ->where('combo_dishes.restaurant_id', $restaurant->id)
                ->get()->toArray();
        }

        $comboDishesDetails = $this->getFormattedComboDishes($comboDishesDetails);

        App::setLocale('en');
        session()->put('locale', 'en');

        return view("$this->moduleView.index", compact('result', 'comboDishes', 'comboDishesDetails'))->with('restaurant', $restaurant);
    }

    public function getFormattedComboDishes($comboDishesDetails)
    {
        foreach ($comboDishesDetails as $key1 => $comboDishesDetail) {
            $categoryArray = [];

            foreach ($comboDishesDetail as $comboDish) {

                $categoryArray[$comboDish['category_name']] = $comboDishesDetail;

                $dishArray = [];
                foreach ($categoryArray[$comboDish['category_name']] as $category) {
                    if ($category['category_name'] == $comboDish['category_name']) {
                        $dishArray[] = $category;
                    }
                }
                $categoryArray[$comboDish['category_name']] = $dishArray;
            }
            $comboDishesDetails[$key1] = $categoryArray;
        }

        return $comboDishesDetails;
    }
}
