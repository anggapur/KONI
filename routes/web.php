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
Route::get('/test','frontController@test');

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

Route::get('data-atlet-front','frontController@dataAtlet');
Route::get('data-prestasi','frontController@dataPrestasi');
Route::get('data-event','frontController@dataEvent');
Route::get('data-pelatih','frontController@dataPelatih');
Route::get('data-wasit-luar','frontController@dataWasit');
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

	//Nomor Pertandingan
	Route::get('/tampilNoPertandingan','noPertandinganController@tampil')->name('nomorPertandingan');
	Route::get('/editNoPertandingan/{id}','noPertandinganController@editNoPertandingan')->name('editNoPertandingan');
	Route::get('/nomorPertandingan', 'noPertandinganController@index');
	Route::post('saveNomorPertandingan','noPertandinganController@simpan');
	Route::get('/data-np','noPertandinganController@getData');
	Route::post('/updateNomorPertandingan','noPertandinganController@update');
	Route::get('hapusNoPertandingan/{id}','noPertandinganController@hapus');

	//Event	
	Route::get('tambahEvent','kejuaraanController@index');
	Route::post('simpanEvent','kejuaraanController@simpan');
	Route::get('/tampilEvent','kejuaraanController@tampil')->name('Kejuaraan');
	Route::get('data-eventPertandingan','kejuaraanController@getData');
	Route::get('editEvent/{id}','kejuaraanController@edit')->name('editEvent');
	Route::post('updateEvent','kejuaraanController@update');
	Route::get('hapusEvent/{id}','kejuaraanController@hapus');	
	Route::post('/get-data-event','kejuaraanController@getDataEvent');

	Route::get('/home', 'HomeController@index')->name('home');

	//Data Atlet
	Route::post('saveDataAtlet','atletController@simpan');
	Route::get('add_atlet','atletController@add_atlet')->name('add_atlet');
	Route::get('view_atlet','atletController@view_atlet')->name('view_atlet');
	Route::get('/data-atlet','atletController@getData');
	Route::post('/get-data-atlet','atletController@getDataAtlet');
	Route::get('/edit_atlet/{id}','atletController@edit_atlet')->name('edit_atlet');
	Route::get('/detail_atlet/{id}','atletController@detail_atlet')->name('detail_atlet');
	Route::post('/update_atlet','atletController@update_atlet');
	Route::post('/update_detail_atlet','atletController@update_detail_atlet');
	Route::get('hapus_atlet/{id}','atletController@hapus_atlet');
	Route::get('view_detail/{id}','atletController@view_detail')->name('view_detail');


	//Kontingen
	Route::get('/kontingen','KontingenController@index')->name('kontingen');
	Route::get('/tambah-kontingen','KontingenController@tambah');
	Route::get('/edit-kontingen/{id}','KontingenController@edit')->name('kontingen-edit');
	Route::get('/data-kontingen','KontingenController@dataKontingen');
	Route::get('/delete-data-kontingen/{id}','KontingenController@hapus');

	Route::post('/add-kontingen','KontingenController@add');	
	Route::post('/get-data-kontingen','KontingenController@getData');	
	Route::post('/update-kontingen','KontingenController@update');
	Route::post('/cek-no-kartu-anggota','KontingenController@cekKartu');	

	//Cabor
	Route::get('/IndexCabor','CabangOlahraga@index')->name('Cabor');
	Route::get('/tambahCabor','CabangOlahraga@tambahcabor');
	Route::get('edit-cabor/{id}','CabangOlahraga@edit_Cabor')->name('edit-cabor');
	Route::get('/data-cabor','CabangOlahraga@dataCabor');
	Route::post('/add-cabor','CabangOlahraga@add');
	Route::get('/delete-data-cabor/{id}','CabangOlahraga@hapus');
	Route::post('/hasiledit-cabor','CabangOlahraga@hasil_editcabor');	

	//Prestasi
	Route::get('/prestasi','PrestasiController@index')->name('Prestasi');
	Route::get('/editPrestasi/{id}','PrestasiController@edit')->name('editPrestasi');
	Route::get('/get-data-prestasi','PrestasiController@getData');
	Route::get('/tambahPrestasi','PrestasiController@tambah');
	Route::get('/delete-data-prestasi/{id}','PrestasiController@delete');

	Route::post('/get-detail-prestasi','PrestasiController@getDetail');
	Route::post('/getNP','PrestasiController@getNP');
	Route::post('/getAtlet','PrestasiController@getAtlet');
	Route::post('/addPrestasi','PrestasiController@addPrestasi');
	Route::post('/editPrestasi','PrestasiController@update');	
	Route::post('/getEvent','PrestasiController@getEvent');

	//Rekor	
	Route::get('/rekor-atlet','RekorController@index')->name('tampilRekor');
	Route::get('/get-data-rekor','RekorController@getData');
	Route::get('/editRekor/{id}','RekorController@edit')->name('editRekor');
	Route::get('/tambahRekor','RekorController@tambah');
	Route::get('/delete-data-rekor/{id}','RekorController@delete');

	Route::post('/get-detail-rekor','RekorController@getRekor');
	Route::post('/addRekor','RekorController@add');
	Route::post('/updateRekor','RekorController@update');
	

	//User
	//Route::get('/admin','adminController@index')->name('view');
	Route::get('/admin/tambah','adminController@formTambah')->name('admin');
	Route::post('/insert','adminController@admin');
	Route::get('/admin/view','adminController@tampil')->name('view');
	Route::get('/admin/{id_user}','adminController@edit')->name('editUser');
	Route::post('/admin/update/{id_user}','adminController@update');
	Route::get('/admin/hapus/{id_user}','adminController@hapus');

	//Wasit

	Route::get('manajemenWasit','wasitController@index');
	Route::post('simpanWasit','wasitController@simpan');
	Route::get('tampilWasit', 'wasitController@tampildata');
	Route::get('wasit/{id}/edit','wasitController@editdata')->name('wasit-edit');
	Route::post('updateWasit','wasitController@update');
	Route::get('hapusWasit/{id}','wasitController@hapusData');
	Route::post('get-data-wasit','wasitController@getData');
	Route::get('data-wasit','wasitController@getDataWasit');

	//Angga Pur CRUD rentang Umur'
	Route::group(['prefix' => 'administrator'],function(){
		Route::get('rentangUmur/getData','rentangUmurController@getData');
		Route::resource('rentangUmur','rentangUmurController');

		Route::get('dataMedali/getData','medaliController@getData');
		Route::resource('medali','medaliController');

		Route::get('dataJuara/getData','juaraController@getData');
		Route::resource('juara','juaraController');
		Route::resource('importData','importDataController');

		Route::get('laporan','laporanController@index');
		Route::post('laporanListDataAtlet','laporanController@listDataAtlet')->name('laporanListDataAtlet');
		Route::post('laporanRekapJumlahAtlet','laporanController@rekapJumlahAtlet')->name('laporanRekapJumlahAtlet');
		Route::post('laporanListDataPrestasi','laporanController@listDataPrestasi')->name('laporanListDataPrestasi');
		Route::post('api/tags','laporanController@apiTags');
		Route::post('generate_pdf','laporanController@generate_pdf')->name('generate_pdf');

	});

	//tingkat_event
	Route::get('tambahdata_event','tingkat_eventController@tambahEvent');
	Route::get('editdata_event/{id}','tingkat_eventController@editEvent');
	Route::post('updatedata_event','tingkat_eventController@updatedata');
	Route::post('simpantingkat','tingkat_eventController@simpan');
	Route::get('tampildata_event','tingkat_eventController@tampilEvent');
	Route::get('deletedata_event/{id}','tingkat_eventController@deleteEvent');
	Route::post('get-data-tingkatEvent','tingkat_eventController@getdataEvent');

	//Level
	Route::resource('level','LevelController');
	Route::get('getDataLevel','LevelController@getData');

	Route::resource('setting','SettingController');
	Route::get('settingData','SettingController@getData')->name('settingData');
	
});