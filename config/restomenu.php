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
        "storage_qr_code" => "qr-code/",
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
        "menu_qr_image_size" => 250,
        "menu_qr_image_ext" => 'svg',
        "menu_qr_image_margin" => 2,
    ],
    "sms" => [
        "is_enabled" => env('SMS_SERVICE_STATUS', 0),
        "username" => env('SPRYNG_USERNAME', 'restomenu'),
        "password" => env('SPRYNG_PASSWORD', 'jaydarryrestomenu'),
        "company" => env('SPRYNG_COMPANY', 'Restomenu'),
    ],
    "reservation_cancel_reasons" => [
        "1" => 'Full today',
        "2" => 'Full on given day',
        "3" => 'Exceptionally Closed today',
        "4" => 'Exceptionally Closed on
        given day',
        "5" => 'Propose other time'
    ],
    "urls" => [
        'restaurant_backend_url' => env('RESTAURANT_BACKEND_URL', "https://my.restomenu.be/"),
        'restaurant_menu_base_url' => env('RESTAURANT_MENU_BASE_URL', "https://menu.restomenu.be/"),
    ]

];
