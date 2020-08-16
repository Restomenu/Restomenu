<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ComboDish;
use App\Models\ComboDishCategory;
use App\Models\ComboDishSubcategory;

use Illuminate\Support\Facades\View;
use App\Models\Dish;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\AppSettingsRepository;


class ComboDishController extends Controller
{
    private $language;

    public function __construct(ComboDish $model, AppSettingsRepository $appSettingsRepository)
    {
        $this->moduleName = "Combo Dish";
        $this->moduleRoute = url('combo-dishes');
        $this->moduleView = "admin.main.combo-dish";
        $this->model = $model;

        $this->appSettingsRepository = $appSettingsRepository;


        // $this->language = array(
        //     'isEnglish' => $appSettingsRepository->getSettings()['admin_language_english'],
        //     'isDutch' => $appSettingsRepository->getSettings()['admin_language_dutch'],
        //     'isFrench' => $appSettingsRepository->getSettings()['admin_language_french'],
        // );

        $this->comboDishImageStoragePath = config("restomenu.path.storage_combo_dish_img");

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
            $result = $this->model->all();
        } elseif ($sessionLangauge == 'nl') {
            $result = $this->model->select('name_dutch as name', 'description_dutch as description', 'image', 'status', 'id');
        } elseif ($sessionLangauge == 'fr') {
            $result = $this->model->select('name_french as name', 'description_french as description', 'image', 'status', 'id');
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
            $categories = Category::pluck('name', 'id')->toArray();
        } elseif ($sessionLangauge == 'nl') {
            $categories = Category::pluck('name_dutch', 'id')->toArray();
        } elseif ($sessionLangauge == 'fr') {
            $categories = Category::pluck('name_french', 'id')->toArray();
        }
        // $categories = Category::pluck('name', 'id')->toArray();
        return view("admin.main.general.create")->with(['language' => $this->language, 'categories' => $categories]);

        // return view("admin.main.general.create", compact('categories'));
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
            $inputs = $request->except('_token', 'combo_dish');

            if ($request->hasFile('image')) {

                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                $file = $request->file('image');

                Storage::put($this->comboDishImageStoragePath . $fileName, file_get_contents($file), 'public');

                $inputs['image'] = $fileName;
            }
            $isSaved = $this->model->create($inputs);
            // dd($isSaved);
            if ($isSaved) {

                if ($request->combo_dish) {
                    for ($i = 0; $i < count($request->combo_dish['category']); $i++) {
                        if ($request->combo_dish['category'][$i] && $request->combo_dish['dish'][$i]) {
                            $comboDishCategory = new ComboDishCategory();
                            $comboDishCategory->combo_dish_id = $isSaved->id;
                            $comboDishCategory->category_id = $request->combo_dish['category'][$i];
                            // $comboDishCategory->dish_id = $request->combo_dish['dish'][$i];
                            $comboDishCategory->dish_quantity = $request->combo_dish['quantity'][$i];

                            $comboDishCategory->save();


                            for ($j = 0; $j < count($request->combo_dish['dish'][$i]); $j++) {
                                $comboDishSubcategory = new ComboDishSubcategory();
                                $comboDishSubcategory->combo_dish_categories_id = $comboDishCategory->id;
                                // $comboDishSubcategory->category_id = $request->combo_dish['category'][$i];
                                $comboDishSubcategory->dish_id = $request->combo_dish['dish'][$i][$j];
                                $comboDishSubcategory->save();
                            }
                        }
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
        $result = $this->model->with('comboDishCategories')->find($id);

        foreach ($result->comboDishCategories as $key => $value) {

            $dishes = Dish::where('category_id', $value->category_id)->pluck('name', 'id')->toArray();
            if ($this->language['isEnglish']) {
                $dishes = Dish::where('category_id', $value->category_id)->pluck('name', 'id')->toArray();
            } elseif ($this->language['isDutch']) {
                $dishes = Dish::where('category_id', $value->category_id)->pluck('name_dutch', 'id')->toArray();
            } elseif ($this->language['isFrench']) {
                $dishes = Dish::where('category_id', $value->category_id)->pluck('name_french', 'id')->toArray();
            }


            $value->dishes = $dishes;

            $value->comboDishDishValues =   ComboDishCategory::leftjoin('combo_dish_subcategories', 'combo_dish_categories.id', '=', 'combo_dish_subcategories.combo_dish_categories_id')->where('combo_dish_categories.combo_dish_id', $id)->where('combo_dish_categories.id', $value->id)->pluck('combo_dish_subcategories.dish_id')->toArray();
        }

        if ($result) {
            $sessionLangauge = session()->get('locale');

            if ($sessionLangauge == 'en') {
                $categories = Category::pluck('name', 'id')->toArray();
            } elseif ($sessionLangauge == 'nl') {
                $categories = Category::pluck('name_dutch', 'id')->toArray();
            } elseif ($sessionLangauge == 'fr') {
                $categories = Category::pluck('name_french', 'id')->toArray();
            }

            return view("admin.main.general.edit", compact('result', 'categories'))->with(['language' => $this->language]);

            // return view("admin.main.general.edit", compact("result", 'categories'));
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
            $result = $this->model->find($id);

            if ($result) {
                $inputs = $request->except('_token', 'combo_dish');


                if ($request->hasFile('image')) {
                    $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                    $file = $request->file('image');

                    Storage::put($this->comboDishImageStoragePath . $fileName, file_get_contents($file), 'public');

                    $inputs['image'] = $fileName;

                    if (isset($result->image) && $result->image) {
                        if (Storage::exists($this->comboDishImageStoragePath . $result->image)) {
                            Storage::delete($this->comboDishImageStoragePath . $result->image);
                        }
                    }
                }

                $isSaved = $result->update($inputs);

                if ($isSaved) {

                    if (array_key_exists('combo_dish', $request->all()) && isset($request->combo_dish)) {

                        ComboDishCategory::where('combo_dish_id', $id)->delete();
                        for ($i = 0; $i < count($request->combo_dish['category']); $i++) {

                            if (($request->combo_dish['category'][$i] && $request->combo_dish['dish'][$i] && !$request->combo_dish['deleteId'][$i])) {
                                $comboDishCategory = new ComboDishCategory();
                                $comboDishCategory->combo_dish_id = $id;
                                $comboDishCategory->category_id = $request->combo_dish['category'][$i];
                                $comboDishCategory->dish_quantity = $request->combo_dish['quantity'][$i];
                                $comboDishCategory->save();

                                for ($j = 0; $j < count($request->combo_dish['dish'][$i]); $j++) {
                                    $comboDishSubcategory = new ComboDishSubcategory();
                                    $comboDishSubcategory->combo_dish_categories_id = $comboDishCategory->id;
                                    $comboDishSubcategory->dish_id = $request->combo_dish['dish'][$i][$j];
                                    $comboDishSubcategory->save();
                                }
                            }
                        }
                        // $deleteIds = array_values(array_filter($request->combo_dish['deleteId']));
                        // ComboDishCategory::where('combo_dish_id', $id)->whereIn('id', $deleteIds)->delete();
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

    public function getDishes(Request $request)
    {

        if ($request->ajax()) {
            $sessionLangauge = session()->get('locale');

            if ($sessionLangauge == 'en') {
                $dishes = Dish::where('category_id', $request->category_id)->pluck("name", "id")->all();
            } elseif ($sessionLangauge == 'nl') {
                $dishes = Dish::where('category_id', $request->category_id)->pluck("name_dutch", "id")->all();
            } elseif ($sessionLangauge == 'fr') {
                $dishes = Dish::where('category_id', $request->category_id)->pluck("name_french", "id")->all();
            }
            // $dishes = Dish::where('category_id', $request->category_id)->pluck("name", "id")->all();
            $data = view('admin.main.combo-dish.select-dishes', compact('dishes'))->render();
            return response()->json(['options' => $data]);
        }
    }
}
