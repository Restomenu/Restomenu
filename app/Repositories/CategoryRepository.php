<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use Carbon\Carbon;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getCategoriesForMenu($restaurantId = null)
    {
        if ($restaurantId) {
            return $this->model->with(['dishes' => function ($query) use ($restaurantId) {
                $query->with('dishAllergens.allergens')->where('dishes.status', 1)->where('restaurant_id', $restaurantId);
            }])->where('status', 1)->where('restaurant_id', $restaurantId)->orderBy('order', 'ASC')->get();
        }
        return $this->model->with(['dishes' => function ($query) {
            $query->where('status', 1);
        }])->where('status', 1)->orderBy('order', 'ASC')->get();
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
        return config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" .  $id . '/' . config("restomenu.path.storage_category_img");
    }

    public function store(array $inputs)
    { }
    public function update(array $inputs, $id)
    { }
    public function getDataTable(Request $request)
    { }
}
