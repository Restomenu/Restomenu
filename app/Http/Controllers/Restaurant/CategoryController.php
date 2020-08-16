<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryIcon;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct(Category $model, CategoryIcon $categoryIconModel)
    {
        $this->moduleName = "Category";
        $this->moduleRoute = url('categories');
        $this->moduleView = "restaurant-new.main.category";
        $this->model = $model;
        $this->categoryIconModel = $categoryIconModel;

        $this->categoryImageStoragePath = config("restomenu.path.storage_category_img");

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
        return view("$this->moduleView.index");
    }

    public function getDatatable()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;

        $sessionLangauge = session()->get('locale');
        if ($sessionLangauge == 'en') {
            $result = $this->model->where('restaurant_id', $restaurantId);
        } elseif ($sessionLangauge == 'nl') {
            $result = $this->model->select('id', 'name_dutch as name', 'description_dutch as description', 'image', 'status')->where('restaurant_id', $restaurantId);
        } elseif ($sessionLangauge == 'fr') {
            $result = $this->model->select('id', 'name_french as name', 'description_french as description', 'image', 'status')->where('restaurant_id', $restaurantId);
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

        return $datatable->orderColumn('name', '-id $1')->addIndexColumn()->make(true);
        // ->orderColumn('name', '-id $1')
        // return Datatables::of($result)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_icons = $this->categoryIconModel->all();
        return view("restaurant-new.main.general.create", compact('category_icons'));
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

            if ($request->hasFile('image')) {

                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                $file = $request->file('image');

                Storage::put($this->categoryImageStoragePath . $fileName, file_get_contents($file), 'public');

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
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $result = $this->model->where('restaurant_id', $restaurantId)->find($id);
        if ($result) {
            $category_icons = $this->categoryIconModel->all();
            return view("restaurant-new.main.general.edit", compact('result', 'category_icons'));

            // return view("restaurant.main.general.edit", compact("result"));
        }
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
                $inputs = $request->except('_token');

                if ($request->hasFile('image')) {
                    $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                    $file = $request->file('image');

                    Storage::put($this->categoryImageStoragePath . $fileName, file_get_contents($file), 'public');

                    $inputs['image'] = $fileName;

                    if (isset($result->image) && $result->image) {
                        if (Storage::exists($this->categoryImageStoragePath . $result->image)) {
                            Storage::delete($this->categoryImageStoragePath . $result->image);
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

    public function categoriesSorting(Request $request)
    {
        $sessionLangauge = session()->get('locale');
        $restaurantId = auth()->guard('restaurant')->user()->id;
        if ($sessionLangauge == 'en') {
            $result = $this->model::select('id', 'name')->where('restaurant_id', $restaurantId)->orderBy('order', 'ASC')->get();
        } elseif ($sessionLangauge == 'nl') {
            $result = $this->model->select('id', 'name_dutch as name')->where('restaurant_id', $restaurantId)->orderBy('order', 'ASC')->get();
        } elseif ($sessionLangauge == 'fr') {
            $result = $this->model->select('id', 'name_french as name')->where('restaurant_id', $restaurantId)->orderBy('order', 'ASC')->get();
        }

        return view("$this->moduleView.sorting", compact('result'));
    }

    public function categoriesSortingUpdate(Request $request)
    {
        try {
            $restaurantId = auth()->guard('restaurant')->user()->id;
            for ($i = 0; $i < count($request->category_id_array); $i++) {
                $category = Category::where('restaurant_id', $restaurantId)->find($request->category_id_array[$i]);
                $category->order = $i;
                $category->save();
            }
            $data = [
                'message' => __('Category Order Changed Successfully.'),
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
