<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AppSettingsRepository;

class DishController extends Controller
{
    public function __construct(Dish $model, Category $categoryModel, AppSettingsRepository $appSettingsRepository)
    {
        $this->moduleName = "Dish";
        $this->moduleRoute = url('dishes');
        $this->moduleView = "admin.main.dishes";
        $this->model = $model;
        $this->categoryModel = $categoryModel;

        $this->appSettingsRepository = $appSettingsRepository;


        // $this->language = array(

        //     'isEnglish' => $appSettingsRepository->getSettings()['admin_language_english'],
        //     'isDutch' => $appSettingsRepository->getSettings()['admin_language_dutch'],
        //     'isFrench' => $appSettingsRepository->getSettings()['admin_language_french'],
        // );
        $this->dishImageStoragePath = config("restomenu.path.storage_dish_img");

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
        $sessionLangauge = session()->get('locale');
        if ($sessionLangauge == 'en') {
            $result = $this->model->select('dishes.id', 'dishes.name as name', 'dishes.description as description', 'dishes.price', 'dishes.image', 'dishes.status', 'categories.name as category_name')->leftjoin('categories', 'categories.id', '=', 'dishes.category_id');
        } elseif ($sessionLangauge == 'nl') {
            $result = $this->model->select('dishes.id', 'dishes.name_dutch as name', 'dishes.description_dutch as description', 'dishes.price', 'dishes.image', 'dishes.status', 'categories.name_dutch as category_name')->leftjoin('categories', 'categories.id', '=', 'dishes.category_id');
        } elseif ($sessionLangauge == 'fr') {
            $result = $this->model->select('dishes.id', 'dishes.name_french as name', 'dishes.description_french as description', 'dishes.price', 'dishes.image', 'dishes.status', 'categories.name_french as category_name')->leftjoin('categories', 'categories.id', '=', 'dishes.category_id');
        }
        $datatable = Datatables::of($result);

        if ($sessionLangauge == 'en') { } elseif ($sessionLangauge == 'nl') {
            $datatable->filterColumn('name', function ($query, $keyword) {
                $sql = "name_dutch like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            });
            $datatable->filterColumn('description', function ($query, $keyword) {
                $sql = "description_dutch like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            });
        } elseif ($sessionLangauge == 'fr') {
            $datatable->filterColumn('name', function ($query, $keyword) {
                $sql = "name_french like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            });
            $datatable->filterColumn('description', function ($query, $keyword) {
                $sql = "description_french like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            });
        }
        return $datatable->addIndexColumn()->make(true);


        // $result = $this->model->select('dishes.*','categories.name as category_name')->leftjoin('categories','categories.id','=','dishes.category_id');

        // return Datatables::of($result)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessionLangauge = session()->get('locale');

        if ($sessionLangauge == 'en') {
            $categories = $this->categoryModel->pluck('name', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        } elseif ($sessionLangauge == 'nl') {
            $categories = $this->categoryModel->pluck('name_dutch', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name_dutch', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        } elseif ($sessionLangauge == 'fr') {
            $categories = $this->categoryModel->pluck('name_french', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name_french', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        }
        // $categories = Category::pluck('name', 'id')->toArray();
        // return view("admin.main.general.create")->with(['language'=>$this->language,'categories'=> $categories]);

        // $categories = $this->categoryModel->pluck('name', 'id')->toArray();
        // $default=$this->categoryModel->whereIn('name',config('restomenu.constants.defaultCategory'))->pluck('id')->first();

        return view("admin.main.general.create", compact('categories', 'default'))->with(['language' => $this->language]);
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

            if ($request->hasFile('image')) {

                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                $file = $request->file('image');

                Storage::put($this->dishImageStoragePath . $fileName, file_get_contents($file), 'public');

                $inputs['image'] = $fileName;
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

        $result = $this->model->find($id);
        if ($result) {
            $sessionLangauge = session()->get('locale');
            if ($sessionLangauge == 'en') {
                $categories = $this->categoryModel->pluck('name', 'id')->toArray();
            } elseif ($sessionLangauge == 'nl') {
                $categories = $this->categoryModel->pluck('name_dutch', 'id')->toArray();
            } elseif ($sessionLangauge == 'fr') {
                $categories = $this->categoryModel->pluck('name_french', 'id')->toArray();
            }

            return view("admin.main.general.edit", compact('result', 'categories'))->with('language', $this->language);

            // return view("admin.main.general.edit", compact("result", 'categories'));
        }
        // if ($result) {

        //     $categories = $this->categoryModel->pluck('name', 'id')->toArray();
        //     return view("admin.main.general.edit", compact("result", "categories"));
        // }

        return redirect($this->moduleRoute)->with("error", __("Sorry, $this->moduleName not found!"));
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
        try {
            $result = $this->model->find($id);

            if ($result) {
                $inputs = $request->except('_token');

                if ($request->hasFile('image')) {
                    $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                    $file = $request->file('image');

                    Storage::put($this->dishImageStoragePath . $fileName, file_get_contents($file), 'public');

                    $inputs['image'] = $fileName;

                    if (isset($result->image) && $result->image) {
                        if (Storage::exists($this->dishImageStoragePath . $result->image)) {
                            Storage::delete($this->dishImageStoragePath . $result->image);
                        }
                    }
                }

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
            $res = $this->model->find($id);
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
