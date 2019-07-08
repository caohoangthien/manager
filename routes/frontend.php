<?php
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

Route::get('/', function () {
    return 'Frontend';
});

Route::auth();

//Route::get('login', 'LoginController@index')->name('login');
//Route::post('login', 'LoginController@post')->name('check-login');
Route::get('logout', 'LoginController@logout')->name('logout');
//
//Route::prefix('quanly')->group(function() {
//    Route::get('/', 'DashboardController@index')->name('client.dashboard');
//});
//
//Route::group(['middleware' => 'checkClientLogin', 'prefix' => 'quanly'], function() {
//    Route::get('/', function() {
//        return view('admin.home');
//    });
//});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/quanly', 'DashboardController@index')->name('client.dashboard');
});