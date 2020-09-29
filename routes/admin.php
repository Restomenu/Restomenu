<?php

// Route::group(['namespace' => 'Admin'], function () {
    Route::group(array('domain' => env('ADMIN_DOMAIN'), 'prefix' => '/', 'namespace' => 'Admin'), function () {
    // Route::group(array('domain' => 'admin.restomenu.local', 'prefix' => '/', 'namespace' => 'Admin'), function () {


    Route::get('home', 'DashboardController@index')->name('admin-home');
    Route::get('lang/{locale}', 'DashboardController@lang')->name('lang');
    Route::get('categories/datatable', 'CategoryController@getDatatable')->name('categories-datatable');
    Route::get('categories/sorting', 'CategoryController@categoriesSorting')->name('categories-sorting');
    Route::post('categories/sorting-update', 'CategoryController@categoriesSortingUpdate')->name('categories-sorting-update');
    Route::resource('categories', 'CategoryController');

    Route::get('dishes/datatable', 'DishController@getDatatable')->name('dishes-datatable');
    Route::resource('dishes', 'DishController');

    Route::get('users/datatable', 'UserController@getDatatable')->name('users-datatable');
    Route::get("users/checkUniqueEmail/{user_id?}", "UserController@checkUniqueEmail")->name('usersCheckUniqueEmail');
    Route::resource('users', 'UserController');

    Route::post('getDishes', ['as' => 'getDishes', 'uses' => 'ComboDishController@getDishes']);
    Route::get('combo-dishes/datatable', 'ComboDishController@getDatatable')->name('combo-dishes-datatable');
    Route::resource('combo-dishes', 'ComboDishController');

    Route::get('settings/datatable', 'SettingController@getDatatable')->name('settings-datatable');
    Route::resource('settings', 'SettingController');

    Route::get('category-icons/datatable', 'CategoryIconController@getDatatable')->name('category-icons-datatable');
    Route::resource('category-icons', 'CategoryIconController');

    Route::get('allergens/datatable', 'AllergensController@getDatatable')->name('allergens-datatable');
    Route::resource('allergens', 'AllergensController');

    Route::get('feedbacks/datatable', 'FeedbackController@getDatatable')->name('feedbacks-datatable');
    Route::resource('feedbacks', 'FeedbackController');

    Route::get('restaurants/datatable', 'RestaurantController@getDatatable')->name('restaurants-datatable');
    Route::get("restaurants/checkUniqueEmail/{restaurant_id?}", "RestaurantController@checkUniqueEmail")->name('restaurantsCheckUniqueEmail');
    Route::get("restaurants/checkUniqueSlug/{restaurant_id?}", "RestaurantController@checkUniqueSlug")->name('restaurantsCheckUniqueSlug');
    Route::resource('restaurants', 'RestaurantController');

    Route::get('visitors/datatable', 'VisitorController@getDatatable')->name('visitors-datatable');
    Route::post('visitors/checkout/{id}', 'VisitorController@editCheckout')->name('visitors-checkout');
    Route::resource('visitors', 'VisitorController');

    Route::get('impersonate/restaurant/{id}', 'ImpersonateController@index')->name('impersonate');

    Route::get('restaurant-feedbacks/datatable', 'RestaurantFeedbackController@getDatatable')->name('restaurant-feedbacks-datatable');
    Route::resource('restaurant-feedbacks', 'RestaurantFeedbackController');

    Route::get('translation/datatable', 'TranslationController@getDatatable')->name('restaurant-datatable');
    // Route::post('visitors/checkout/{id}', 'TranslationController@editCheckout')->name('visitors-checkout');
    Route::resource('translation', 'TranslationController');
    Route::get('restaurant-types/datatable', 'RestaurantTypeController@getDatatable')->name('restaurant-types-datatable');
    Route::resource('restaurant-types', 'RestaurantTypeController');

    Route::get('cities/datatable', 'CityController@getDatatable')->name('cities-datatable');
    Route::resource('cities', 'CityController');


    // Route::get('/migrate', function () {
    //     Artisan::call('migrate');
    //     return 'migrate';
    // });
});
