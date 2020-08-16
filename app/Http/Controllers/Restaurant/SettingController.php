<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;


class SettingController extends Controller
{
    public function __construct(Setting $model)
    {
        $this->moduleName = "Setting";
        // $this->moduleRoute = url('settings');
        $this->moduleView = "restaurant-new.main.setting";
        $this->model = $model;

        $this->siteLogoStoragePath = config("restomenu.path.storage_logo");
        $this->categoryImageStoragePath = config("restomenu.path.storage_category_img");

        View::share('module_name', $this->moduleName);
        // View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);

        $this->statusCodes = config("restomenu.responseCodes");
    }


    public function edit()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $result = $this->model->where('restaurant_id', $restaurantId)->first();
        $selectedLanguage = [];

        if ($result) {
            if ($result->admin_language_english == 1) {
                $selectedLanguage['en'] = 'English';
            }
            if ($result->admin_language_dutch == 1) {
                $selectedLanguage['nl'] = 'Dutch';
            }
            if ($result->admin_language_french == 1) {
                $selectedLanguage['fr'] = 'French';
            }
            return view($this->moduleView . ".index", compact("result", "selectedLanguage"));
        }
        // return redirect()->back()->with("error", __("Sorry, $this->moduleName not found!"));

        return redirect()->back()->with("error", __("Sorry, $this->moduleName not found!"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        $result = $this->model->where('restaurant_id', $restaurantId)->first();
        try {
            if ($result) {

                $inputs = $request->except('_token');

                //site logo setting
                if ($request->site_logo) {
                    if ($request->hasFile('site_logo')) {
                        $fileName = 'site-logo' . time() . '.' . $request->site_logo->getClientOriginalExtension();
                        $file = $request->file('site_logo');

                        Storage::put($this->siteLogoStoragePath . $fileName, file_get_contents($file), 'public');

                        $inputs['site_logo'] = $fileName;

                        if (isset($result->site_logo) && $result->site_logo) {
                            if (Storage::exists($this->siteLogoStoragePath . $result->site_logo)) {
                                Storage::delete($this->siteLogoStoragePath . $result->site_logo);
                            }
                        }
                    }
                }

                //front-side language setting(At least one active language)
                if (!$request->language_french && !$request->language_english &&    !$request->language_dutch) {
                    return redirect(route('restaurant.settings-edit'))->with("error", __("At least one active language required!"));
                }
                //backend-side language setting(At least one active language)

                if (!$request->admin_language_french && !$request->admin_language_english && !$request->admin_language_dutch) {
                    return redirect(route('restaurant.settings-edit'))->with("error", __("At least one active language required for admin panel!"));
                }

                //defualt langauge can't inactive

                if (!$request->admin_language_english && $result->defualt_language == 'en' || !$request->admin_language_english && $request->defualt_language == 'en') {
                    return redirect(route('restaurant.settings-edit'))->with("error", "Sorry! You Can't Inactive Default langauge  English");
                } elseif (!$request->admin_language_dutch && $result->defualt_language == 'nl' || !$request->admin_language_dutch && $request->defualt_language == 'nl') {
                    return redirect(route('restaurant.settings-edit'))->with("error", "Sorry! You Can't Inactive Default langauge Dutch");
                } elseif (!$request->admin_language_french && $result->defualt_language == 'fr' || !$request->admin_language_french && $request->defualt_language == 'fr') {
                    return redirect(route('restaurant.settings-edit'))->with("error", "Sorry! You Can't Inactive Default langauge French");
                }

                $isSaved = $result->update($inputs);
                $sessionLangauge = session()->get('locale');

                if ($isSaved) {
                    if ($sessionLangauge == 'en') {
                        session()->put('locale', $result->defualt_language);
                    } elseif ($sessionLangauge == 'nl') {
                        session()->put('locale', $result->defualt_language);
                    } elseif ($sessionLangauge == 'fr') {
                        session()->put('locale', $result->defualt_language);
                    }
                    return redirect(route('restaurant.home'))->with("success", __("Settings updated!"));
                }
            }
            return redirect(route('restaurant.settings-edit'))->with("error", __("Something went wrong, please try again later."));
        } catch (\Exception $e) {
            return redirect(route('restaurant.settings-edit'))->with('error', $e->getMessage());
        }
    }
}
