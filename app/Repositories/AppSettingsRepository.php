<?php

namespace App\Repositories;

use App\Models\Setting;

class AppSettingsRepository
{
    public static function getSettings()
    {
        // $restaurantId = auth()->guard('restaurant')->user()->id;
        // $settingArr = Setting::where('restaurant_id', $restaurantId);
        $settingArr = Setting::all();
        $allSetting = [];
        foreach ($settingArr as $settingData) {
            $allSetting[$settingData['key']] = $settingData['value'];
        }
        if (!isset($allSetting['language_english'])) {
            $allSetting['language_english'] = 1;
        }
        if (!isset($allSetting['language_dutch'])) {
            $allSetting['language_dutch'] = 1;
        }
        if (!isset($allSetting['language_french'])) {
            $allSetting['language_french'] = 1;
        }

        // $totalAvailableLanguageArr = Setting::selectRaw('SUM(value) as total_available_language')->where('key', 'language_english')->orwhere('key', 'language_dutch')->orwhere('key', 'language_french')->first()->toArray();

        // $allSetting['total-available-language'] = (int) $totalAvailableLanguageArr['total_available_language'];

        return $allSetting;
    }
}
