<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\RestaurantRepository;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function __construct(Visitor $model, RestaurantRepository $restaurantRepository)
    {
        $this->model = $model;
        $this->restaurantRepository = $restaurantRepository;

        $this->statusCodes = config("restomenu.responseCodes");
    }

    public function store(Request $request, $slug)
    {
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);
        try {

            $inputs = $request->except('_token');
            $inputs['restaurant_id'] = $restaurant->id;

            $inputs['checkin_at'] = Carbon::now()->toDateTimeString();

            $this->model->create($inputs);

            $data = [
                'message' => __('Registration successful.'),
            ];
            return response()->json($data, $this->statusCodes['success']);
        } catch (\Exception $e) {
            $data = [
                'message' => $e->getMessage()
            ];
            return response()->json($data, $this->statusCodes['serverSide']);
        }
    }
}
