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
Route::get('atlet/{id}/{nama}','frontController@detailAtlet');
Route::get('data-atlet','frontController@dataAtlet');
Route::get('data-prestasi','frontController@dataPrestasi');
Route::get('data-event','frontController@dataEvent');
Route::get('data-pelatih','frontController@dataPelatih');
Route::get('data-wasit','frontController@dataWasit');
Route::post('getApiData','frontController@getApiData');
// Cabor Detail
Route::get('cabor/{id}/{nama}','frontController@detailCabor');
Route::get('data-atlet-di-cabor/{id_cabor}','frontController@dataAtletDiCabor');
Route::get('data-pelatih-di-cabor/{id_cabor}','frontController@dataPelatihDiCabor');
Route::get('data-wasit-di-cabor/{id_cabor}','frontController@dataWasitDiCabor');
Route::get('data-np-di-cabor/{id_cabor}','frontController@dataNPDiCabor');
//evennt detail
Route::get('event/{id}/{nama}','frontController@detailEvent');
Route::get('data-prestasi-di-event/{id_event}','frontController@dataPrestasiDiEvent');



Auth::routes();

Route::group(['middleware' => 'auth'],function(){
	//only admin can acces here

	Route::get('/nomorPertandingan', 'noPertandingan@index')->name('nomorPertandingan');
	Route::post('saveNomorPertandingan','noPertandingan@simpan');

	Route::get('/home', 'HomeController@index')->name('home');


	//Kontingen
	Route::get('/kontingen','KontingenController@index')->name('kontingen');
	Route::get('/tambah-kontingen','KontingenController@tambah');
	Route::get('/edit-kontingen/{id}','KontingenController@edit')->name('kontingen-edit');
	Route::get('/data-kontingen','KontingenController@dataKontingen');
	Route::post('/add-kontingen','KontingenController@add');
	Route::post('/get-data-kontingen','KontingenController@getData');
	Route::post('/delete-data-kontingen','KontingenController@hapus');
	Route::post('/update-kontingen','KontingenController@update');
	Route::post('/cek-no-kartu-anggota','KontingenController@cekKartu');

	Route::get('/admin','adminController@index')->name('admin');
	//yg dikiri link
	Route::post('/insert','adminController@admin');
	Route::get('/admin/view','adminController@tampil')->name('view');
	Route::get('/admin/{id_user}','adminController@edit');
	Route::post('/admin/update/{id_user}','adminController@update');
	Route::get('/admin/hapus/{id_user}','adminController@hapus');

});
