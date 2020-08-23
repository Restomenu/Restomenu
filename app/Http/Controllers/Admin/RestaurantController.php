<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RestaurantRegister;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Repositories\RestaurantRepository;
use Illuminate\Support\Facades\Mail;

// use App\Repositories\AppSettingsRepository;

class RestaurantController extends Controller
{
    public function __construct(Restaurant $model, Setting $settingModel, RestaurantRepository $restaurantRepository)
    {
        $this->moduleName = "Restaurants";
        $this->moduleRoute = url('restaurants');
        $this->moduleView = "admin.main.restaurant";
        $this->model = $model;
        $this->settingModel = $settingModel;
        $this->restaurantRepository = $restaurantRepository;

        // $this->appSettingsRepository = $appSettingsRepository;

        // $this->language = [
        //     'isEnglish' => $appSettingsRepository->getSettings()['admin_language_english'],
        //     'isDutch' => $appSettingsRepository->getSettings()['admin_language_dutch'],
        //     'isFrench' => $appSettingsRepository->getSettings()['admin_language_french'],
        // ];

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
        $result = $this->model->all();

        return Datatables::of($result)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.main.general.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:restaurants,email,NULL,id,deleted_at,NULL',
            'password' => 'required',
            'image' => 'required',
            'slug' => 'required|unique:restaurants,slug,NULL,id,deleted_at,NULL',
            'color' => 'required',
            'available_sms_count' => 'required|numeric'
        ]);

        try {
            $inputs = $request->except('_token', 'image', 'color', 'password', 'available_sms_count');
            $inputs['password'] = bcrypt($request->password);
            $isSaved = $this->model->create($inputs);

            if ($isSaved) {
                if ($request->hasFile('image')) {
                    $fileName = 'site-logo' . time() . '.' . $request->image->getClientOriginalExtension();
                    $file = $request->file('image');

                    Storage::put($this->restaurantRepository->getImagePath($isSaved->id) . $fileName, file_get_contents($file));
                }

                $settingInputs = [
                    "restaurant_id" => $isSaved->id,
                    "site_logo" => $fileName,
                    "site_name" => $request->name,
                    "available_sms_count" => (int) $request->available_sms_count,
                    "language_english" => 1,
                    "language_dutch" => 1,
                    "language_french" => 1,
                    "admin_language_english" => 1,
                    "admin_language_dutch" => 1,
                    "admin_language_french" => 1,
                    "defualt_language" => 'en',
                    "menu_primary_color" => $request->color,
                ];

                $this->settingModel->create($settingInputs);
                $data = [
                    "name" => $isSaved->name
                ];
                Mail::to($isSaved->email)->queue(new RestaurantRegister($data));

                return redirect($this->moduleRoute)->with("success", __($this->moduleName . ' Added Successfully.'));
            }
            return redirect($this->moduleRoute)->with("error", __("Something went wrong, please try again later."));
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }

    public function checkUniqueEmail(Request $request, $restaurant_id = null)
    {
        if ($restaurant_id) {
            $restaurant = $this->model->where('email', $request->email)->where('id', '!=', $restaurant_id)->get();
            return (($restaurant->count() > 0) ? "false" : "true");
        }

        $restaurant = $this->model->where('email', $request->email)->get();
        return (($restaurant->count() > 0) ? "false" : "true");
    }

    public function checkUniqueSlug(Request $request, $restaurant_id = null)
    {
        if ($restaurant_id) {
            $restaurant = $this->model->where('slug', $request->slug)->where('id', '!=', $restaurant_id)->get();
            return (($restaurant->count() > 0) ? "false" : "true");
        }

        $restaurant = $this->model->where('slug', $request->slug)->get();
        return (($restaurant->count() > 0) ? "false" : "true");
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
        $result = $this->model->with('setting')->find($id);

        if ($result) {
            return view("admin.main.general.edit", compact("result"));
        }
        return redirect($this->moduleRoute)->with("error", "Sorry, $this->moduleName not found!");
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:restaurants,email,' . $id . ',id,deleted_at,NULL',
            'slug' => 'required|unique:restaurants,slug,' . $id . ',id,deleted_at,NULL',
            'color' => 'required',
            'available_sms_count' => 'required|numeric'
        ]);

        try {
            $result = $this->model->find($id);
            $setting = $this->settingModel->where('restaurant_id', $id)->first();

            if ($result) {
                $inputs = $request->except('_token', 'image', 'color', 'password', 'available_sms_count');

                if ($request->password) {
                    $inputs['password'] = bcrypt($request->password);
                }

                $isSaved = $result->update($inputs);

                if ($isSaved) {

                    if ($request->hasFile('image')) {
                        $fileName = 'site-logo' . time() . '.' . $request->image->getClientOriginalExtension();
                        $file = $request->file('image');
                        Storage::put($this->restaurantRepository->getImagePath($id) . $fileName, file_get_contents($file));

                        if (isset($setting->site_logo) && $setting->site_logo) {
                            if (Storage::exists($this->restaurantRepository->getImagePath($id) . $setting->site_logo)) {
                                Storage::delete($this->restaurantRepository->getImagePath($id) . $setting->site_logo);
                            }
                        }
                        $setting->site_logo = $fileName;
                    }
                    $setting->site_name = $request->name;
                    $setting->menu_primary_color = $request->color;
                    $setting->available_sms_count = $request->available_sms_count;
                    $setting->save();

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
