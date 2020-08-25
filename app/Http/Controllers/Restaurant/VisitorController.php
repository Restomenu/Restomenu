<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function __construct(Visitor $model)
    {
        $this->moduleName = "Customer";
        $this->moduleRoute = url('visitors');
        $this->moduleView = "restaurant-new.main.visitors";
        $this->model = $model;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
    }

    public function index()
    {
        return view("$this->moduleView.index");
    }

    public function getDatatable(Request $request)
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $result = $this->model->where('restaurant_id', $restaurantId)->orderBy('checkin_at', 'asc')->whereNull('checkout_at');

        if ($request->visitorsFilterValue === 'all') {
            $result = $this->model->where('restaurant_id', $restaurantId)->orderBy('checkin_at', 'desc');
        } elseif ($request->visitorsFilterValue === 'checkIn') {
            $result = $this->model->where('restaurant_id', $restaurantId)->orderBy('checkin_at', 'asc')->whereNull('checkout_at');
        } elseif ($request->visitorsFilterValue === 'checkOut') {
            $result = $this->model->where('restaurant_id', $restaurantId)->orderBy('checkin_at', 'desc')->whereNotNull('checkout_at');
        }

        $result->whereDate('checkin_at', Carbon::today());

        return Datatables::of($result)->addIndexColumn()->make(true);
    }

    public function editCheckout($id)
    {
        try {
            $restaurantId = auth()->guard('restaurant')->user()->id;
            $result = $this->model->where('restaurant_id', $restaurantId)->find($id);
            $inputs['checkout_at'] = Carbon::now()->toDateTimeString();
            $isSaved = $result->update($inputs);

            if ($isSaved) {
                return response()->json(['message' => __('Status changed successfully.')]);
            } else {
                return redirect($this->moduleRoute)->with("error", __("Something went wrong, please try again later."));
            }
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("restaurant-new.main.general.create-simple");
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
            $inputs = $request->except('_token', 'checkin_date', 'checkin_time');
            $inputs['restaurant_id'] = auth()->guard('restaurant')->user()->id;

            if (!$request->checkin_at) {
                $inputs['checkin_at'] = Carbon::now()->toDateTimeString();
            } else {
                $inputs['checkin_at'] = Carbon::createFromFormat('Y-m-d H:i', $request->checkin_at)->format('Y-m-d H:i:s');
            }

            $isSaved = $this->model->create($inputs);

            if ($isSaved) {
                return redirect($this->moduleRoute)->with("success", __($this->moduleName . ' Added Successfully.'));
            }
            return redirect($this->moduleRoute)->with("error", __("Something went wrong, please try again later."));
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
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
        $result = [];

        try {
            $restaurantId = auth()->guard('restaurant')->user()->id;
            $res = $this->model->where('restaurant_id', $restaurantId)->find($id);
            if ($res) {
                $res->delete();

                $result['message'] = __($this->moduleName . " Deleted Successfully.");
                $result['code'] = 200;
            } else {
                $result['code'] = 400;
                $result['message'] = __("Something went wrong, please try again later.");
            }
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            $result['code'] = 400;
        }

        return response()->json($result, $result['code']);
    }
}
