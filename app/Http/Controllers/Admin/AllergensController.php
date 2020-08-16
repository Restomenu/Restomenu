<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Allergens;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class AllergensController extends Controller
{
    public function __construct(Allergens $model)
    {
        $this->moduleName = "Allergens";
        $this->moduleRoute = url('allergens');
        $this->moduleView = "admin.main.allergens";
        $this->model = $model;

        $this->iconStoragePath = config("restomenu.path.storage_allergens_icons");

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
        $this->validate($request, [
            'icon' => 'required',
            'icon.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        try {
            $inputs = $request->except('_token');

            $icons = $request->file('icon');

            if ($request->hasFile('icon')) {
                foreach ($icons as $key => $icon) {
                    $fileName = time() . rand() . '.' .  $icon->getClientOriginalExtension();
                    Storage::put($this->iconStoragePath . $fileName, file_get_contents($icon));
                    $inputs['icon'] = $fileName;
                    $isSaved = $this->model->create($inputs);
                }
            }

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
            return view("admin.main.general.edit", compact('result'));
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

                if ($request->hasFile('icon')) {
                    $fileName = time() . '.' . $request->icon->getClientOriginalExtension();
                    $file = $request->file('icon');

                    Storage::put($this->iconStoragePath . $fileName, file_get_contents($file), 'public');

                    $inputs['icon'] = $fileName;

                    if (isset($result->icon) && $result->icon) {
                        if (Storage::exists($this->iconStoragePath . $result->icon)) {
                            Storage::delete($this->iconStoragePath . $result->icon);
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
