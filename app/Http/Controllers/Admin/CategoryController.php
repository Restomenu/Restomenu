<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryIcon;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AppSettingsRepository;

class CategoryController extends Controller
{
    private $language;

    public function __construct(Category $model, CategoryIcon $categoryIconModel, AppSettingsRepository $appSettingsRepository)
    {
        $this->moduleName = "Category";
        $this->moduleRoute = url('categories');
        $this->moduleView = "admin.main.category";
        $this->model = $model;
        $this->categoryIconModel = $categoryIconModel;
        $this->appSettingsRepository = $appSettingsRepository;

        // $this->language = array(

        //     'isEnglish' => $appSettingsRepository->getSettings()['admin_language_english'],
        //     'isDutch' => $appSettingsRepository->getSettings()['admin_language_dutch'],
        //     'isFrench' => $appSettingsRepository->getSettings()['admin_language_french'],
        // );

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
        $sessionLangauge = session()->get('locale');
        if ($sessionLangauge == 'en') {
            $result = $this->model->orderBy('order', 'ASC')->get();
        } elseif ($sessionLangauge == 'nl') {
            $result = $this->model->select('id', 'name_dutch as name', 'description_dutch as description', 'image', 'status')->orderBy('order', 'ASC');
        } elseif ($sessionLangauge == 'fr') {
            $result = $this->model->select('id', 'name_french as name', 'description_french as description', 'image', 'status')->orderBy('order', 'ASC');
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
        return view("admin.main.general.create", compact('category_icons'))->with('language', $this->language);
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
        $result = $this->model->find($id);
        if ($result) {
            $category_icons = $this->categoryIconModel->all();
            return view("admin.main.general.edit", compact('result', 'category_icons'))->with(['language' => $this->language]);

            // return view("admin.main.general.edit", compact("result"));
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
        if ($sessionLangauge == 'en') {
            $result = $this->model::select('id', 'name')->orderBy('order', 'ASC')->get();
        } elseif ($sessionLangauge == 'nl') {
            $result = $this->model->select('id', 'name_dutch as name')->orderBy('order', 'ASC')->get();
        } elseif ($sessionLangauge == 'fr') {
            $result = $this->model->select('id', 'name_french as name')->orderBy('order', 'ASC')->get();
        }

        return view("$this->moduleView.sorting", compact('result'));
    }

    public function categoriesSortingUpdate(Request $request)
    {
        try {
            for ($i = 0; $i < count($request->category_id_array); $i++) {
                $category = Category::find($request->category_id_array[$i]);
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
