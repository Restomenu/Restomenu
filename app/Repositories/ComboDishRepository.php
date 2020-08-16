<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use App\Models\ComboDish;
use DB;
use Carbon\Carbon;

class ComboDishRepository extends BaseRepository
{
    public function __construct(ComboDish $comboDish)
    {
        $this->model = $comboDish;
    }

    public function getAllActive($restaurantId = null)
    {
        if ($restaurantId) {
            return $this->model::where('restaurant_id', $restaurantId)->where('status', 1)->get();
        }
        return $this->model::where('status', 1)->get();
    }

    public static function getImagePath($id)
    {
        return config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $id . '/' . config("restomenu.path.storage_combo_dish_img");
    }

    public function store(array $inputs)
    { }
    public function update(array $inputs, $id)
    { }
    public function getDataTable(Request $request)
    { }
}
