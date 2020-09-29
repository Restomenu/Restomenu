<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function __construct(Translation $model)
    {
        $this->moduleName = "Translation";
        $this->moduleRoute = url('translation');
        $this->moduleView = "admin.main.translation";
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
        // dd('hello');
        $result = $this->model->leftjoin('restaurants', 'restaurants.id', '=', 'translation.restaurant_id')->select("translation.*", "restaurants.name as restaurant_name" ,"restaurants.email as restaurant_email","restaurants.slug")->orderBy('created_at', 'asc')->get();
        // dd($request->translationFilterValue === 'pending');
        
       
        if ($request->translationFilterValue === 'all') {
            
            $result = $this->model->leftjoin('restaurants', 'restaurants.id', '=', 'translation.restaurant_id')->select("translation.*", "restaurants.name as restaurant_name" ,"restaurants.email as restaurant_email","restaurants.slug")->orderBy('created_at', 'asc')->get();
        } elseif ($request->translationFilterValue === 'approved') {
            $result = $this->model->leftjoin('restaurants', 'restaurants.id', '=', 'translation.restaurant_id')->select("translation.*", "restaurants.name as restaurant_name" ,"restaurants.email as restaurant_email","restaurants.slug")->where('translation.status',1)->orderBy('created_at', 'asc')->get();
        } elseif ($request->translationFilterValue === 'pending') {
            $result = $this->model->leftjoin('restaurants', 'restaurants.id', '=', 'translation.restaurant_id')->select("translation.*", "restaurants.name as restaurant_name" ,"restaurants.email as restaurant_email","restaurants.slug")->where('translation.status',0)->orderBy('created_at', 'asc')->get();

        }

        return Datatables::of($result)->addIndexColumn()->make(true);
    }

    public function edit($id)
    {
        $result = $this->model->find($id);
        // dd($result);
        if ($result) {
            return view("admin.main.general.edit", compact("result"));
        }
        return redirect($this->moduleRoute)->with("error", __("Sorry, $this->moduleName not found!"));
    }

    public function update(Request $request, $id)
    {
        try {
            $result = $this->model->find($id);

            if ($result) {
                $inputs = $request->except('_token');

               

                $isSaved = $result->update($inputs);

                if ($isSaved) {
                    return redirect($this->moduleRoute)->with("success", __($this->moduleName . " updated!"));
                }
            }
            return redirect($this->moduleRoute)->with("error", __("Something went wrong, please try again later."));
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }
}
