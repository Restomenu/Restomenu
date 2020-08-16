<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AppSettingsRepository;

class SettingController extends Controller
{
    public function __construct(Setting $model, AppSettingsRepository $appSettingsRepository)
    {
        $this->moduleName = "Setting";
        $this->moduleRoute = url('settings');
        $this->moduleView = "admin.main.setting";
        $this->model = $model;

        $this->appSettingsRepository = $appSettingsRepository;
        $this->siteLogoStoragePath = config("restomenu.path.storage_logo");

        // $this->language = array(

        //     'isEnglish' => $appSettingsRepository->getSettings()['language_english'],
        //     'isDutch' => $appSettingsRepository->getSettings()['language_dutch'],
        //     'isFrench' => $appSettingsRepository->getSettings()['language_french'],
        // );
        // $this->adminLanguage = array(

        //     'isEnglishAdmin' => $appSettingsRepository->getSettings()['admin_language_english'],
        //     'isDutchAdmin' => $appSettingsRepository->getSettings()['admin_language_dutch'],
        //     'isFrenchAdmin' => $appSettingsRepository->getSettings()['admin_language_french'],
        // );

        $this->categoryImageStoragePath = config("restomenu.path.storage_category_img");
        // $this->defaultLangauge = $appSettingsRepository->getSettings()['defualt_language'];

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);

        $this->statusCodes = config("restomenu.responseCodes");
    }
    public function index()
    {
        $result = $this->model->all();
        return view("$this->moduleView.index", compact("result"));
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

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id, Request $request)
    {
        $result = $this->model->find($id);

        $setting = $request->setting;
        $selectedLanguage = [];

        if ($this->adminLanguage['isEnglishAdmin'] == 1) {
            $selectedLanguage['en'] = 'English';
        }
        if ($this->adminLanguage['isDutchAdmin'] == 1) {
            $selectedLanguage['nl'] = 'Dutch';
        }
        if ($this->adminLanguage['isFrenchAdmin'] == 1) {
            $selectedLanguage['fr'] = 'French';
        }

        if ($result) {
            return view("admin.main.general.edit", compact("result", "setting", "selectedLanguage"));
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
                if ($request->key == 'language_french' || $request->key == 'language_dutch' || $request->key == 'language_english') {

                    if (!$request->value) {
                        if (($request->key == 'language_french' && (($this->language['isEnglish'] == 1 || $this->language['isDutch'] == 1))) || ($request->key == 'language_dutch' && (($this->language['isEnglish'] == 1 || $this->language['isFrench'] == 1))) || ($request->key == 'language_english' && (($this->language['isDutch'] == 1 || $this->language['isFrench'] == 1)))
                        ) {

                            $isSaved = $result->update($inputs);
                            if ($isSaved) {
                                return redirect($this->moduleRoute)->with("success", __($this->moduleName . " updated!"));
                            }
                        } else {
                            return redirect($this->moduleRoute)->with("error", __("At least one active language required!"));
                        }
                    } else {
                        $isSaved = $result->update($inputs);
                        if ($isSaved) {
                            return redirect($this->moduleRoute)->with("success", __($this->moduleName . " updated!"));
                        }
                    }
                }
                if ($request->key == 'admin_language_french' || $request->key == 'admin_language_dutch' || $request->key == 'admin_language_english') {
                    if (!$request->value) {
                        // dd($this->defaultLangauge);
                        if (($request->key == 'admin_language_french' && (($this->adminLanguage['isEnglishAdmin'] == 1 || $this->adminLanguage['isDutchAdmin'] == 1))) || ($request->key == 'admin_language_dutch' && (($this->adminLanguage['isEnglishAdmin'] == 1 || $this->adminLanguage['isFrenchAdmin'] == 1))) || ($request->key == 'admin_language_english' && (($this->adminLanguage['isDutchAdmin'] == 1 || $this->adminLanguage['isFrenchAdmin'] == 1)))
                        ) {
                            if ($request->key == 'admin_language_english' && $this->defaultLangauge == 'en') {
                                return redirect($this->moduleRoute)->with("error", "Sorry! Your Default langauge is English");
                            } elseif ($request->key == 'admin_language_dutch' && $this->defaultLangauge == 'nl') {
                                return redirect($this->moduleRoute)->with("error", "Sorry! Your Default langauge is Dutch");
                            } elseif ($request->key == 'admin_language_french' && $this->defaultLangauge == 'fr') {
                                return redirect($this->moduleRoute)->with("error", "Sorry! Your Default langauge is French");
                            }
                            $sessionLangauge = session()->get('locale');

                            $isSaved = $result->update($inputs);
                            if ($isSaved) {
                                // $sessionLangauge = session()->get('locale');
                                if ($sessionLangauge == 'en') {
                                    session()->put('locale', $this->defaultLangauge);
                                } elseif ($sessionLangauge == 'nl') {
                                    session()->put('locale', $this->defaultLangauge);
                                } elseif ($sessionLangauge == 'fr') {
                                    session()->put('locale', $this->defaultLangauge);
                                }
                                return redirect($this->moduleRoute)->with("success", __($this->moduleName . " updated!"));
                            }
                        } else {
                            return redirect($this->moduleRoute)->with("error", __("At least one active language required!"));
                        }
                    } else {
                        $isSaved = $result->update($inputs);
                        if ($isSaved) {
                            return redirect($this->moduleRoute)->with("success", __($this->moduleName . " updated!"));
                        }
                    }
                }

                if ($request->key == 'site_logo') {
                    if ($request->hasFile('value')) {
                        $fileName = 'site-logo' . time() . '.' . $request->value->getClientOriginalExtension();
                        $file = $request->file('value');

                        Storage::put($this->siteLogoStoragePath . $fileName, file_get_contents($file), 'public');

                        $inputs['value'] = $fileName;

                        if (isset($result->value) && $result->value) {
                            if (Storage::exists($this->siteLogoStoragePath . $result->value)) {
                                Storage::delete($this->siteLogoStoragePath . $result->value);
                            }
                        }
                    }

                    $isSaved = $result->update($inputs);

                    if ($isSaved) {
                        return redirect($this->moduleRoute)->with("success", __($this->moduleName . " updated!"));
                    }
                }
                if (in_array($request->key, ['site_name', 'fb_url', 'ig_url', 'tw_url'])) {

                    $isSaved = $result->update($inputs);

                    if ($isSaved) {
                        return redirect($this->moduleRoute)->with("success", __($this->moduleName . " updated!"));
                    }
                }
                if ($request->key == 'defualt_language') {

                    $isSaved = $result->update($inputs);
                    session()->put('locale', $inputs['value']);

                    if ($isSaved) {
                        return redirect($this->moduleRoute)->with("success", __($this->moduleName . " updated!"));
                    }
                }
            }
            return redirect($this->moduleRoute)->with("error", __("Something went wrong, please try again later."));
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }
}
