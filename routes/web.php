<?php

use Illuminate\Support\Facades\Route;
// use App\Repositories\AppSettingsRepository;
// use App\Repositories\RestaurantRepository;
// use App\Models\Restaurant;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => env('MENU_DOMAIN'), 'prefix' => "/"], function () {
  // Route::get('/', function () {
  //   return view('welcome');
  // });

  Route::get('/{slug}', 'Front\MenuController@index')->name('select-language');
  Route::get('/{slug}/nl', 'Front\MenuController@menuDutch')->name('menu-nl');
  Route::get('/{slug}/fr', 'Front\MenuController@menuFrench')->name('menu-fr');
  Route::get('/{slug}/en', 'Front\MenuController@menuEnglish')->name('menu-en');

  Route::resource('/{slug}/menu-feedbacks', 'Front\FeedbackController');
  Route::post('/{slug}/menu-visitors', 'Front\VisitorController@store')->name('menu-visitor-save');

  // Route::get('/{slug}/fire-event',  function ($slug) {
  //   $restaurantRepo = new RestaurantRepository(new Restaurant);
  //   $restaurant = $restaurantRepo->getRestaurantFromSlug($slug);
  //   // dd($restaurant);
  //   event(new \App\Events\ReservationEvent($restaurant));
  // });

  // if (AppSettingsRepository::getSettings()['total-available-language'] > 1) {

  //   Route::get('/', 'Front\MenuController@selectLanguage')->name('select-language');
  //   Route::get('/nl', 'Front\MenuController@menuDutch')->name('menu-nl');
  //   Route::get('/fr', 'Front\MenuController@menuFrench')->name('menu-fr');
  //   Route::get('/en', 'Front\MenuController@menuEnglish')->name('menu-en');
  // } else {

  //   if (AppSettingsRepository::getSettings()['language_dutch']) {
  //     Route::get('/', 'Front\MenuController@menuDutch')->name('menu-nl');
  //   } elseif (AppSettingsRepository::getSettings()['language_french']) {
  //     Route::get('/', 'Front\MenuController@menuFrench')->name('menu-fr');
  //   } elseif (AppSettingsRepository::getSettings()['language_english']) {
  //     Route::get('/', 'Front\MenuController@menuEnglish')->name('menu-en');
  //   }
  // }

  // artisan commands
  Route::get('/command/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage Linked';
  });

  Route::get('/command/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Optimize Clear';
  });

  Route::get('/command/cache-clear', function () {
    Artisan::call('cache:clear');
    return 'Cache Clear';
  });

  Route::get('/command/config-clear', function () {
    Artisan::call('config:clear');
    return 'config Clear';
  });

  Route::get('/cron/visitor-checkout', 'Cron\VisitorCheckOutController@index');
  Route::get('/cron/visitor-delete', 'Cron\VisitorDeleteController@index');
});

// Route::group(['domain' => env('TAKEAWAY_DOMAIN'), 'prefix' => "/"], function () {

//   if (AppSettingsRepository::getSettings()['total-available-language'] > 1) {

//     Route::get('/', 'Front\MenuController@selectLanguage')->name('select-language');
//     Route::get('/nl', 'Front\MenuController@menuDutch')->name('menu-nl');
//     Route::get('/fr', 'Front\MenuController@menuFrench')->name('menu-fr');
//     Route::get('/en', 'Front\MenuController@menuEnglish')->name('menu-en');
//   } else {

//     if (AppSettingsRepository::getSettings()['language_dutch']) {
//       Route::get('/', 'Front\MenuController@menuDutch')->name('menu-nl');
//     } elseif (AppSettingsRepository::getSettings()['language_french']) {
//       Route::get('/', 'Front\MenuController@menuFrench')->name('menu-fr');
//     } elseif (AppSettingsRepository::getSettings()['language_english']) {
//       Route::get('/', 'Front\MenuController@menuEnglish')->name('menu-en');
//     }
//   }
// });
// Auth::routes(['verify' => true]);

// Route::group(["middleware" => ["auth", "verified"]], function () {

//   Route::get('/home', 'HomeController@index')->name('home');
// });

// Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
Route::group(array('domain' => env('ADMIN_DOMAIN')), function () {

  Route::get('/', 'AdminAuth\LoginController@showLoginForm');
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin-login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin-logout');

  // Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  // Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Route::group(['domain' => env('RESTAURANT_DOMAIN'), 'as' => 'restaurant.'], function () {
  Route::get('/', 'RestaurantAuth\LoginController@showLoginForm');
  Route::get('/login', 'RestaurantAuth\LoginController@showLoginForm')->name('show-login-form');
  Route::post('/login', 'RestaurantAuth\LoginController@login')->name('login');
  Route::post('/logout', 'RestaurantAuth\LoginController@logout')->name('logout');
  Route::get('/register', 'RestaurantAuth\RegisterController@showRegistrationForm')->name('show-registration-form');

  Route::post('/register', 'RestaurantAuth\RegisterController@register')->name('register');

  Route::post('/password/email', 'RestaurantAuth\ForgotPasswordController@sendResetLinkEmail')->name('send-password-reset-link');
  Route::post('/password/reset', 'RestaurantAuth\ResetPasswordController@reset')->name('password-reset');
  Route::get('/password/reset', 'RestaurantAuth\ForgotPasswordController@showLinkRequestForm')->name('password-reset-form');
  Route::get('/password/reset/{token}', 'RestaurantAuth\ResetPasswordController@showResetForm');

  // restaurant.impersonate.destroy
  Route::get('/impersonate/destroy', 'Admin\ImpersonateController@destroy')->name('impersonate.destroy');

  Route::get('/auth/lang/{locale}', 'Restaurant\DashboardController@lang')->name('auth.lang');

  // Route::get('/test/forgot-password-mail', 'Test\TestController@forgotPasswordMail');
  // Route::get('/test/restaurant-register-mail', 'Test\TestController@restaurantRegisterMail');
});

Route::group(['domain' => env('RESERVATION_DOMAIN'), 'as' => 'reservation.'], function () {
  // Route::get('/{slug}', 'Reservation\ReservationController@index');

  Route::get('/{slug}', 'Reservation\ReservationController@index')->name('select-language');
  Route::get('/{slug}/{locale}', 'Reservation\ReservationController@reservationIndex')->name('reservation-index')->where('locale', 'en|nl|fr');

  Route::post('/{slug}/reservation', 'Reservation\ReservationController@store')->name('reservation-save');
  Route::post('/{slug}/reservation-time-check', 'Reservation\ReservationController@timeCheck')->name('reservation-time-check');
});
