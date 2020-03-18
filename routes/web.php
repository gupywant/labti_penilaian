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
    return view('welcome');
});
Route::get('admin',function(){
	return redirect(route('admin.loginpage'));
});
Route::get('admin/login',['as'=>'admin.loginpage','uses'=>'loginAdminController@index']);
Route::post('admin/loginCheck',['as'=>'admin.login','uses' =>'loginAdminController@login']);
Route::get('admin/logout',['as'=>'admin.logout','uses' =>'loginAdminController@logout']);
Route::middleware('sessionHasAdmin')->prefix('admin')->group(function () {
	Route::get('dashboard',['as'=>'admin.dashboard', 'uses'=>'dashboardController@index']);
});
Route::get('admin/test',['as'=>'admin.test','uses'=>'loginAdminController@test']);