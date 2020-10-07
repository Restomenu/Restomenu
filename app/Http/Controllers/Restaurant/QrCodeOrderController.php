<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Setting;
use App\Models\QrCodeOrder;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Library\Spryng\Client;
// use SpryngApiHttpPhp\Client;
use SpryngApiHttpPhp\Exception\InvalidRequestException;

class QrCodeOrderController extends Controller
{
    
    public function __construct(QrCodeOrder $model)
    {
        
        $this->moduleName = "Qr Code Order";
        $this->moduleRoute = url('qr-code-order');
        $this->moduleView = "restaurant-new.main.qr_code.orders";
        $this->model = $model;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("$this->moduleView.index");
        
    }
    public function getDatatable()
    {
        // dd('hello');
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $result = $this->model->where('restaurant_id', $restaurantId);

        return Datatables::of($result)->addIndexColumn()->make(true);
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
            $inputs = $request->except('_token','total_cost','sticker_cost','shipping_cost');
            $shipping_cost=config('restomenu.price.shipping_price');
            $sticker_cost=config('restomenu.price.sticker_price');
            $total_cost= (($request->quantity * $sticker_cost ) + floatval($shipping_cost));
            $inputs['restaurant_id'] = auth()->guard('restaurant')->user()->id;
            $inputs['total_cost'] = $total_cost;
            $inputs['shipping_cost'] = $shipping_cost;
            $inputs['sticker_cost'] = $sticker_cost;

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
        //
    }
}
