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




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
	//only admin can acces here
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/admin','adminController@index')->name('admin');
	//yg dikiri link
	Route::post('/insert','adminController@admin');
	Route::get('/admin/view','adminController@tampil')->name('view');
	Route::get('/admin/{id_user}','adminController@edit');
	Route::post('/admin/update/{id_user}','adminController@update');
	Route::get('/admin/hapus/{id_user}','adminController@hapus');
});
