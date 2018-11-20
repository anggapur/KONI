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

// Route By Angga Purnajiwa
//Route::get('alit', 'isengController@index');
Route::get('/','frontController@index');
Route::get('dataGrafik','frontController@dataGrafik');
Route::get('atlet','frontController@atlet');
Route::get('prestasi-atlet','frontController@prestasiAtlet');
Route::get('pelatih','frontController@pelatih');
Route::get('wasit','frontController@wasit');
Route::get('event','frontController@event');
Route::get('cabor','frontController@cabor');
Route::get('cabor','frontController@cabor');
Route::get('rekor','frontController@rekor');

Route::get('data-atlet','frontController@dataAtlet');

Route::post('getApiData','frontController@getApiData');

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
	//only admin can acces here
	Route::get('/home', 'HomeController@index')->name('home');

	//Kontingen
	Route::get('/kontingen','KontingenController@index')->name('kontingen');
	Route::get('/tambah-kontingen','KontingenController@tambah');
	Route::get('/edit-kontingen/{id}','KontingenController@edit')->name('kontingen-edit');
	Route::get('data-kontingen','KontingenController@dataKontingen');
	Route::post('/add-kontingen','KontingenController@add');
	Route::post('/get-data-kontingen','KontingenController@getData');
	Route::post('/delete-data-kontingen','KontingenController@hapus');
	Route::post('/update-kontingen','KontingenController@update');


});
