<?php

Route::group(['domain' => env('RESTAURANT_DOMAIN'), 'namespace' => 'Restaurant'], function () {
    // Route::group(['domain' =>"restaurant.restomenu.local", 'namespace' => 'Restaurant'], function () {
    Route::get('home', 'DashboardController@index')->name('home');
    Route::get('lang/{locale}', 'DashboardController@lang')->name('lang');
    Route::get('categories/datatable', 'CategoryController@getDatatable')->name('categories-datatable');
    Route::get('categories/sorting', 'CategoryController@categoriesSorting')->name('categories-sorting');
    Route::post('categories/sorting-update', 'CategoryController@categoriesSortingUpdate')->name('categories-sorting-update');
    Route::resource('categories', 'CategoryController');

    Route::get('dishes/datatable', 'DishController@getDatatable')->name('dishes-datatable');
    Route::get('dishes/multiple-create', 'DishController@multipleCreate')->name('dishes-multiple-create');
    Route::post('dishes/multiple-store', 'DishController@multipleStore')->name('dishes-multiple-store');
    Route::resource('dishes', 'DishController');

    Route::get('users/datatable', 'UserController@getDatatable')->name('users-datatable');
    Route::get("users/checkUniqueEmail/{user_id?}", "UserController@checkUniqueEmail")->name('usersCheckUniqueEmail');
    Route::resource('users', 'UserController');

    Route::post('getDishes', ['as' => 'getDishes', 'uses' => 'ComboDishController@getDishes']);
    Route::get('combo-dishes/datatable', 'ComboDishController@getDatatable')->name('combo-dishes-datatable');
    Route::resource('combo-dishes', 'ComboDishController');

    // Route::get('settings/datatable', 'SettingController@getDatatable')->name('settings-datatable');
    Route::get('settings', 'SettingController@edit')->name('settings-edit');
    Route::post('settings', 'SettingController@update')->name('settings-update');

    Route::get('restaurant-setting', 'RestaurantSettingController@edit')->name('restaurant-setting-edit');
    Route::post('restaurant-setting', 'RestaurantSettingController@update')->name('restaurant-setting-update');

    Route::get('category-icons/datatable', 'CategoryIconController@getDatatable')->name('category-icons-datatable');
    Route::resource('category-icons', 'CategoryIconController');

    Route::get('feedbacks/datatable', 'FeedbackController@getDatatable')->name('feedbacks-datatable');
    Route::resource('feedbacks', 'FeedbackController');

    Route::get('visitors/datatable', 'VisitorController@getDatatable')->name('visitors-datatable');
    Route::post('visitors/checkout/{id}', 'VisitorController@editCheckout')->name('visitors-checkout');

    Route::resource('visitors', 'VisitorController');

    Route::get('reservations/datatable', 'ReservationController@getDatatable')->name('reservations-datatable');
    Route::resource('reservations', 'ReservationController');

    Route::post('reservations/status-update', 'ReservationController@statusUpdate')->name('reservation-status-update');

    Route::resource('restaurant-feedbacks', 'RestaurantFeedbackController');

    Route::get('get-notification-data', 'NotificationController@getNotificationData')->name('get-notification-data');

    Route::get('qr-code', 'QrCodeController@index')->name('qr-code.index');
    Route::get('qr-code/download', 'QrCodeController@download')->name('qr-code.download');
    Route::get('qr-code/print', 'QrCodeController@print')->name('qr-code.print');

    // Route::get('qr-code-order', 'QrCodeOrderController@index')->name('qr-code.index');
    Route::get('qr-code-order/datatable', 'QrCodeOrderController@getDatatable')->name('qr-code-order-datatable');

    Route::resource('qr-code-order', 'QrCodeOrderController');
});
Route::group(['domain' => 'my.restomenu.local', 'namespace' => 'Restaurant'], function () { });
