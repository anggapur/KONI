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

Route::get('angga','contohController@index');

// By Angga Purnajiwa
Route::get('/','frontController@index');
Route::get('dataGrafik','frontController@dataGrafik');
Route::get('atlet','frontController@atlet');
Route::get('prestasi-atlet','frontController@prestasi-atlet');
Route::get('pelatih','frontController@pelatih');
Route::get('wasit','frontController@wasit');
Route::get('event','frontController@event');

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
	//only admin can acces here
	Route::get('/home', 'HomeController@index')->name('home');
});
