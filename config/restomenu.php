<?php

return [
    "responseCodes" => [
        "success" => 200,
        "successWithEmpty" => 201,
        "unauthorized" => 401,
        "forbidden" => 403,
        "formValidation" => 400,
        "badRequest" => 400,
        "conflict" => 409,
        "notFound" => 404,
        "serverSide" => 500
    ],

    "path" => [
        "storage_restaurant_images_root_dir" => "restaurant_images/",
        "storage_category_img" => "category-icons/",
        "storage_dish_img" => "dish/",
        "storage_combo_dish_img" => "combo-dish/",
        "storage_logo" => "site-logo/",
        "storage_icon" => "category-icons/",
        "storage_allergens_icons" => "allergens-icons/",
    ],
    "constants" => [
        "frontUserDefaultTimezone" => 'America/New_York',
        "adminUserDefaultTimezone" => 'America/New_York',

        "adminDefaultDateFormatToDisplay" => 'm-d-Y',
        "currencySign" => '€',

        "defaultCategory" => [
            'Others', 'others', 'other', 'others', 'Divers', 'Autres'
        ],
        "site_logo_path" => 'storage/site-logo/',
    ]

];
