<?php

Route::group(['domain' => env('RESTAURANT_DOMAIN'), 'namespace' => 'Restaurant'], function () {
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

    Route::get('category-icons/datatable', 'CategoryIconController@getDatatable')->name('category-icons-datatable');
    Route::resource('category-icons', 'CategoryIconController');

    Route::get('feedbacks/datatable', 'FeedbackController@getDatatable')->name('feedbacks-datatable');
    Route::resource('feedbacks', 'FeedbackController');

    Route::get('visitors/datatable', 'VisitorController@getDatatable')->name('visitors-datatable');
    Route::post('visitors/checkout/{id}', 'VisitorController@editCheckout')->name('visitors-checkout');
    Route::post('visitors/status-update', 'VisitorController@statusUpdate')->name('visitors-status-update');
    Route::resource('visitors', 'VisitorController');

    Route::resource('restaurant-feedbacks', 'RestaurantFeedbackController');
});
