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
	//praktikum
	Route::get('praktikum',['as'=>'admin.praktikum', 'uses'=>'praktikumController@index']);
	Route::post('praktikumAdd',['as'=>'admin.praktikumAdd', 'uses'=>'praktikumController@tambah']);
	Route::get('userReset/{id}',['as'=>'admin.userReset', 'uses'=>'praktikumController@resetUser']);
	Route::get('delete/{id}',['as'=>'admin.delete', 'uses'=>'praktikumController@delete']);
	Route::get('la/{id}',['as'=>'admin.la', 'uses'=>'praktikumController@indexLa']);
	Route::post('uploadla',['as'=>'admin.uploadla', 'uses'=>'praktikumController@uploadLa']);
	Route::get('deletela/{id}',['as'=>'admin.deletela', 'uses'=>'praktikumController@deleteLa']);
	Route::get('download/{id}',['as'=>'admin.download', 'uses'=>'praktikumController@downloadLa']);
	//list nilai
	Route::get('listnilai',['as'=>'admin.listnilai', 'uses'=>'listnilaiController@index']);
	Route::get('nilai/{id}',['as'=>'admin.nilai', 'uses'=>'listnilaiController@nilai']);
	//urut nilai
	Route::get('nilaiurut',['as'=>'admin.nilaiurut', 'uses'=>'ImportController@index']);
	Route::post('import',['as'=>'admin.import', 'uses'=>'ImportController@import']);
});


Route::get('asisten',function(){
	return redirect(route('asisten.loginpage'));
});
Route::get('asisten/login',['as'=>'asisten.loginpage','uses'=>'loginAsistenController@index']);
Route::post('asisten/loginCheck',['as'=>'asisten.login','uses' =>'loginAsistenController@login']);
Route::get('asisten/logout',['as'=>'asisten.logout','uses' =>'loginAsistenController@logout']);
Route::middleware('sessionHasAsisten')->prefix('asisten')->group(function () {
	Route::get('dashboard',['as'=>'asisten.dashboard', 'uses'=>'dashboardController@indexAsisten']);
	Route::get('la',['as'=>'asisten.la', 'uses'=>'praktikumController@asistenLa']);
	Route::get('download/{id}',['as'=>'asisten.download', 'uses'=>'praktikumController@downloadLa']);
	//list nilai
	Route::get('listnilai',['as'=>'asisten.listnilai', 'uses'=>'nilaiController@index']);
	Route::get('nilai/{id}',['as'=>'asisten.nilai', 'uses'=>'nilaiController@nilai']);
	Route::post('edit',['as'=>'asisten.edit', 'uses'=>'nilaiController@edit']);
});
Route::get('admin/test',['as'=>'admin.test','uses'=>'loginAdminController@test']);