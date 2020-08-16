<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Repositories\RestaurantRepository;

class FeedbackController extends Controller
{

    public function __construct(Feedback $model, RestaurantRepository $restaurantRepository)
    {
        $this->model = $model;
        $this->restaurantRepository = $restaurantRepository;

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
    public function store(Request $request, $slug)
    {
        // $this->validate($request, [
        //     'ratings' => 'required',
        // ]);

        // dd($request->all());
        $restaurant = $this->restaurantRepository->getRestaurantFromSlug($slug);
        try {

            $inputs = $request->except('_token');
            $inputs['restaurant_id'] = $restaurant->id;

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
