<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use DB;
use Carbon\Carbon;

class RestaurantRepository extends BaseRepository
{
    public function __construct(Restaurant $restaurant)
    {
        $this->model = $restaurant;
    }

    public function getAllActive()
    {
        return $this->model::where('status', 1)->get();
    }

    public function getRestaurantFromSlug($slug)
    {
        $restaurant = $this->model->where("slug", $slug)->with(['setting', 'restaurantTime'])->first();

        if ($restaurant) {
            return $restaurant;
        } else {
            abort(404);
        }
    }

    public static function getImagePath($id)
    {
        return config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $id . '/' . config("restomenu.path.storage_logo");
    }

    public function store(array $inputs)
    { }
    public function update(array $inputs, $id)
    { }
    public function getDataTable(Request $request)
    { }
}
