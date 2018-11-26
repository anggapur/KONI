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

	Route::get('/tampilNoPertandingan','noPertandinganController@tampil')->name('nomorPertandingan');
	Route::get('/editNoPertandingan/{id}','noPertandinganController@editNoPertandingan')->name('editNoPertandingan');
	Route::get('/nomorPertandingan', 'noPertandinganController@index');
	Route::post('saveNomorPertandingan','noPertandinganController@simpan');
	Route::get('/data-np','noPertandinganController@getData');
	Route::post('/updateNomorPertandingan','noPertandinganController@update');
	Route::get('hapusNoPertandingan/{id}','noPertandinganController@hapus');
	
	Route::get('kejuaraan','kejuaraanController@index')->name('kejuaraan');
	Route::post('simpanEvent','kejuaraanController@simpan');
	Route::get('/tampilEvent','kejuaraanController@tampil')->name('kejuaraan');
	Route::get('data-eventPertandingan','kejuaraanController@getData');
	Route::get('editEvent/{id}','kejuaraanController@edit')->name('editEvent');
	Route::post('updateEvent','kejuaraanController@update');
	Route::get('hapusEvent/{id}','kejuaraanController@hapus');

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
	Route::get('/kontingen/{msg}','KontingenController@msg');

	//Cabor
	Route::get('/IndexCabor','CabangOlahraga@index')->name('Cabor');
	Route::get('/tambah-kontingen','KontingenController@tambah');
	Route::get('/edit-kontingen/{id}','KontingenController@edit')->name('kontingen-edit');
	Route::get('/data-kontingen','KontingenController@dataKontingen');
	Route::post('/add-kontingen','KontingenController@add');
	Route::post('/get-data-kontingen','KontingenController@getData');
	Route::post('/delete-data-kontingen','KontingenController@hapus');
	Route::post('/update-kontingen','KontingenController@update');
	Route::post('/cek-no-kartu-anggota','KontingenController@cekKartu');
	Route::get('/kontingen/{msg}','KontingenController@msg');

	//Prestasi
	Route::get('/prestasi','PrestasiController@index')->name('Prestasi');
	Route::get('/editPrestasi/{id}','PrestasiController@edit')->name('editPrestasi');
	Route::get('/get-data-prestasi','PrestasiController@getData');
	Route::get('/tambahPrestasi','PrestasiController@tambah');
	Route::get('/prestasi/{msg}','PrestasiController@msg');

	Route::post('/get-detail-prestasi','PrestasiController@getDetail');
	Route::post('/getNP','PrestasiController@getNP');
	Route::post('/getAtlet','PrestasiController@getAtlet');
	Route::post('/addPrestasi','PrestasiController@addPrestasi');
	Route::post('/editPrestasi','PrestasiController@update');
	Route::post('/delete-data-prestasi','PrestasiController@delete');
	Route::post('/getEvent','PrestasiController@getEvent');

	//Rekor	
	Route::get('/rekor-atlet','RekorController@index')->name('tampilRekor');
	Route::get('/get-data-rekor','RekorController@getData');
	Route::get('/editRekor/{id}','RekorController@edit')->name('editRekor');
	Route::get('/tambahRekor','RekorController@tambah');
	Route::get('/rekor/{msg}','RekorController@msg');

	Route::post('/get-detail-rekor','RekorController@getRekor');
	Route::post('/addRekor','RekorController@add');
	Route::post('/updateRekor','RekorController@update');
	Route::post('/delete-data-rekor','RekorController@delete');

	//User
	Route::get('/admin','adminController@index')->name('view');
	Route::get('/admin/tambah','adminController@formTambah')->name('admin');
	Route::post('/insert','adminController@admin');
	Route::get('/admin/view','adminController@tampil')->name('view');
	Route::get('/admin/{id_user}','adminController@edit');
	Route::post('/admin/update/{id_user}','adminController@update');
	Route::get('/admin/hapus/{id_user}','adminController@hapus');

	//Angga Pur CRUD rentang Umur'
	Route::group(['prefix' => 'administrator'],function(){
		Route::get('rentangUmur/getData','rentangUmurController@getData');
		Route::resource('rentangUmur','rentangUmurController');

		Route::resource('importData','importDataController');
	});


	Route::get('manajemenWasit','wasitController@index');
	Route::post('simpanWasit','wasitController@simpan');
	Route::get('tampilWasit', 'wasitController@tampildata');
	Route::get('wasit/{id}/edit','wasitController@editdata');
	Route::post('updateWasit','wasitController@update');
	Route::get('hapusWasit/{id}','wasitController@hapusData');
	Route::post('get-data-wasit','wasitController@getData');
});

