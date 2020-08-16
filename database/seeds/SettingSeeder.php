<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'display_name' => 'Site Logo',
                'key' => 'site_logo',
                'value' => 'site-logo1592940563.png',
            ],
            [
                'display_name' => 'Site Name',
                'key' => 'site_name',
                'value' => null,
            ],
            [
                'display_name' => 'English Language',
                'key' => 'language_english',
                'value' => 1,
            ],
            [
                'display_name' => 'Dutch Language',
                'key' => 'language_dutch',
                'value' => 1,
            ],
            [
                'display_name' => 'French Language',
                'key' => 'language_french',
                'value' => 1,
            ],
            [
                'display_name' => 'Facebook URL',
                'key' => 'fb_url',
                'value' => null,
            ],
            [
                'display_name' => 'Instagram URL',
                'key' => 'ig_url',
                'value' => null,
            ],
            [
                'display_name' => 'Twitter URL',
                'key' => 'tw_url',
                'value' => null,
            ]

        ]);
    }
}
