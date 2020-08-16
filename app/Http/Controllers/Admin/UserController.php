<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(User $model)
    {
        $this->moduleName = "Customer";
        $this->moduleRoute = url('users');
        $this->moduleView = "admin.main.users";
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
        try {
            $inputs = $request->except('_token', 'password');
            $inputs['password'] = bcrypt($request->password);
            $inputs['email_verified_at'] = Carbon::now();

            $isSaved = $this->model->create($inputs);

            if ($isSaved) {
                return redirect($this->moduleRoute)->with("success", __($this->moduleName . ' Added Successfully.'));
            }
            return redirect($this->moduleRoute)->with("error", __("Something went wrong, please try again later."));
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }

    public function checkUniqueEmail(Request $request, $user_id = null)
    {
        if ($user_id) {
            $user = User::where('email', $request->email)->where('id', '!=', $user_id)->get();
            return (($user->count() > 0) ? "false" : "true");
        }

        $user = User::where('email', $request->email)->get();
        return (($user->count() > 0) ? "false" : "true");
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
            return view("admin.main.general.edit", compact("result"));
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
                $inputs = $request->except('_token', 'password');

                if ($request->password) {
                    $inputs['password'] = bcrypt($request->password);
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
