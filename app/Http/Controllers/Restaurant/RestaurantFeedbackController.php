<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantFeedback;
use Illuminate\Support\Facades\View;

class RestaurantFeedbackController extends Controller
{
    public function __construct(RestaurantFeedback $model)
    {
        $this->moduleName = "Feedback";
        $this->moduleRoute = url('restaurant-feedbacks');
        $this->moduleView = "restaurant-new.main.restaurant-feedback";
        $this->model = $model;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
        $this->statusCodes = config("restomenu.responseCodes");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $inputs = $request->except('_token');
            $inputs['restaurant_id'] = auth()->guard('restaurant')->user()->id;

            $this->model->create($inputs);

            $data = [
                'message' => __('Comment Sent Successfully.'),
            ];
            return response()->json($data, $this->statusCodes['success']);
        } catch (\Exception $e) {
            $data = [
                'message' => $e->getMessage()
            ];
            return response()->json($data, $this->statusCodes['serverSide']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
