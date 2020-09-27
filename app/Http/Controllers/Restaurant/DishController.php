<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use App\Models\Allergens;
use App\Models\DishAllergens;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Repositories\DishRepository;

class DishController extends Controller
{
    public function __construct(Dish $model, Category $categoryModel, DishAllergens $dishAllergensModel, Allergens $allergensModel, DishRepository $dishRepository)
    {
        $this->moduleName = "Dish";
        $this->moduleRoute = url('dishes');
        $this->moduleView = "restaurant-new.main.dishes";
        $this->model = $model;
        $this->categoryModel = $categoryModel;
        $this->dishAllergensModel = $dishAllergensModel;
        $this->allergensModel = $allergensModel;
        $this->dishRepository = $dishRepository;

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
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $sessionLangauge = session()->get('locale');
        if ($sessionLangauge == 'en') {
            $result = $this->model->select('dishes.id', 'dishes.restaurant_id', 'dishes.name as name', 'dishes.description as description', 'dishes.price', 'dishes.image', 'dishes.status', 'categories.name as category_name')->leftjoin('categories', 'categories.id', '=', 'dishes.category_id')->where('dishes.restaurant_id', $restaurantId);
        } elseif ($sessionLangauge == 'nl') {
            $result = $this->model->select('dishes.id', 'dishes.restaurant_id', 'dishes.name_dutch as name', 'dishes.description_dutch as description', 'dishes.price', 'dishes.image', 'dishes.status', 'categories.name_dutch as category_name')->leftjoin('categories', 'categories.id', '=', 'dishes.category_id')->where('dishes.restaurant_id', $restaurantId);
        } elseif ($sessionLangauge == 'fr') {
            $result = $this->model->select('dishes.id', 'dishes.restaurant_id', 'dishes.name_french as name', 'dishes.description_french as description', 'dishes.price', 'dishes.image', 'dishes.status', 'categories.name_french as category_name')->leftjoin('categories', 'categories.id', '=', 'dishes.category_id')->where('dishes.restaurant_id', $restaurantId);
        }
        $datatable = Datatables::of($result);

        if ($sessionLangauge == 'en') { } elseif ($sessionLangauge == 'nl') {
            $datatable->filterColumn('dishes.name', function ($query, $keyword) {
                $sql = "dishes.name_dutch like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            });
            $datatable->filterColumn('dishes.description', function ($query, $keyword) {
                $sql = "dishes.description_dutch like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            });
        } elseif ($sessionLangauge == 'fr') {
            $datatable->filterColumn('dishes.name', function ($query, $keyword) {
                $sql = "dishes.name_french like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            });
            $datatable->filterColumn('dishes.description', function ($query, $keyword) {
                $sql = "dishes.description_french like ?";
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
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $allergens = $this->allergensModel->all();

        if ($sessionLangauge == 'en') {
            $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        } elseif ($sessionLangauge == 'nl') {
            $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name_dutch', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name_dutch', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        } elseif ($sessionLangauge == 'fr') {
            $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name_french', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name_french', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        }
        // $categories = Category::pluck('name', 'id')->toArray();
        // return view("restaurant.main.general.create")->with(['language'=>$this->language,'categories'=> $categories]);

        // $categories = $this->categoryModel->pluck('name', 'id')->toArray();
        // $default=$this->categoryModel->whereIn('name',config('restomenu.constants.defaultCategory'))->pluck('id')->first();

        return view("restaurant-new.main.general.create", compact('categories', 'default', 'allergens'));
    }

    public function multipleCreate()
    {
        $sessionLangauge = session()->get('locale');
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $allergens = $this->allergensModel->all();

        if ($sessionLangauge == 'en') {
            $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        } elseif ($sessionLangauge == 'nl') {
            $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name_dutch', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name_dutch', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        } elseif ($sessionLangauge == 'fr') {
            $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name_french', 'id')->toArray();
            $default = $this->categoryModel->whereIn('name_french', config('restomenu.constants.defaultCategory'))->pluck('id')->first();
        }

        return view("$this->moduleView.multiple-create", compact('categories', 'default', 'allergens'));
    }

    public function multipleStore(Request $request)
    {
        try {
            $inputs = $request->except('_token');
            $inputs['restaurant_id'] = auth()->guard('restaurant')->user()->id;

            for ($i = 0; $i < count($inputs['name']); $i++) {
                $dish = new Dish();
                $dish->name = $inputs['name'][$i];
                $dish->name_dutch = $inputs['name_dutch'][$i];
                $dish->name_french = $inputs['name_french'][$i];
                $dish->description = $inputs['description'][$i];
                $dish->description_dutch = $inputs['description_dutch'][$i];
                $dish->description_french = $inputs['description_french'][$i];
                $dish->category_id = $inputs['category_id'][$i];
                $dish->price = $inputs['price'][$i];
                $dish->status = $inputs['status'][$i];
                $dish->restaurant_id = $inputs['restaurant_id'];
                $dish->save();
            }
            return redirect($this->moduleRoute)->with("success", __($this->moduleName . ' Added Successfully.'));
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->allergens_icons[0]);

        try {
            $inputs = $request->except('_token', 'allergens_icons');
            $inputs['restaurant_id'] = auth()->guard('restaurant')->user()->id;

            if ($request->hasFile('image')) {

                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                $file = $request->file('image');

                Storage::put($this->dishRepository->getImagePath(auth()->guard('restaurant')->user()->id) . $fileName, file_get_contents($file));

                $inputs['image'] = $fileName;
            }
            $isSaved = $this->model->create($inputs);

            if ($isSaved) {

                if ($request->exists('allergens_icons') && $request->allergens_icons) {

                    for ($i = 0; $i < count($request->allergens_icons); $i++) {
                        $dishAllergens = new DishAllergens();
                        $dishAllergens->dish_id = $isSaved->id;
                        $dishAllergens->allergen_id = $request->allergens_icons[$i];
                        $dishAllergens->save();
                    }
                }
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

        $restaurantId = auth()->guard('restaurant')->user()->id;
        $allergens = $this->allergensModel->all();

        $allergensList = DishAllergens::where('dish_id', $id)->pluck('allergen_id')->toArray();

        $result = $this->model->where('restaurant_id', $restaurantId)->find($id);
        if ($result) {
            $sessionLangauge = session()->get('locale');
            if ($sessionLangauge == 'en') {
                $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name', 'id')->toArray();
            } elseif ($sessionLangauge == 'nl') {
                $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name_dutch', 'id')->toArray();
            } elseif ($sessionLangauge == 'fr') {
                $categories = $this->categoryModel->where('restaurant_id', $restaurantId)->pluck('name_french', 'id')->toArray();
            }

            return view("restaurant-new.main.general.edit", compact('result', 'categories', 'allergens', 'allergensList'));

            // return view("restaurant.main.general.edit", compact("result", 'categories'));
        }
        // if ($result) {

        //     $categories = $this->categoryModel->pluck('name', 'id')->toArray();
        //     return view("restaurant.main.general.edit", compact("result", "categories"));
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
            $restaurantId = auth()->guard('restaurant')->user()->id;
            $result = $this->model->where('restaurant_id', $restaurantId)->find($id);


            if ($result) {
                $inputs = $request->except('_token', 'allergens_icons');


                if ($request->hasFile('image')) {
                    $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                    $file = $request->file('image');

                    Storage::put($this->dishRepository->getImagePath($restaurantId) . $fileName, file_get_contents($file));

                    $inputs['image'] = $fileName;

                    if (isset($result->image) && $result->image) {
                        if (Storage::exists($this->dishRepository->getImagePath($restaurantId) . $result->image)) {
                            Storage::delete($this->dishRepository->getImagePath($restaurantId) . $result->image);
                        }
                    }
                }

                $isSaved = $result->update($inputs);

                if ($isSaved) {
                    DishAllergens::where('dish_id', $id)->delete();

                    if ($request->exists('allergens_icons') && $request->allergens_icons) {

                        for ($i = 0; $i < count($request->allergens_icons); $i++) {
                            $dishAllergens = new DishAllergens();
                            $dishAllergens->dish_id = $id;
                            $dishAllergens->allergen_id = $request->allergens_icons[$i];
                            $dishAllergens->save();
                        }
                    }
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
