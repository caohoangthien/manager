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
Route::get('logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('trang-chu', 'DashboardController@index')->name('client.dashboard');
    Route::resource('nhan-vien', 'EmployeeController');
    Route::get('cham-cong', 'LogWorkController@show')->name('cham-cong.index');
    Route::get('log-work-months', 'LogWorkController@getMonths')->name('cham-cong.get-log-work-months');
});