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
Route::get('nomorPertandingan','contohController@index');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
	//only admin can acces here
	Route::get('/nomorPertandingan', 'noPertandinganController@index')->name('nomorPertandingan');
	Route::post('saveNomorPertandingan','noPertandinganController@simpan');
});
