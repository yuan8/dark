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

// Route::get('/', function () {
//
// });

Route::get('/init/{tahun}','INIT\InitialTahunCtrl@careteDb' );
Route::get('/init-drop/{tahun}','INIT\InitialTahunCtrl@dropTable' );


Route::get('/db','INIT\InitialTahunCtrl@back');
Route::get('/db-init-bidang/{tahun}','INIT\InitialTahunCtrl@createBidang');
Route::get('/perbaikan/{tw}','PERBAIKAN@index')->name('perbaikan');
Route::get('/perbaikan-init/{kode_daerah?}','PERBAIKAN@init')->name('pinit');



Route::get('/home',function(){
	return redirect('/');
});
	Route::get('login','Auth\LoginController@view')->name('login');





Route::get('/', 'HomeController@index')->name('home');
Route::get('/pilih-tahun', 'INIT\InitialTahunCtrl@front_pilih_tahun')->name('f.pilih_tahun');
Route::post('/pilih-tahun', 'INIT\InitialTahunCtrl@store_front_pilih_tahun')->name('f.pilih_tahun.store');

Route::middleware('auth:web')->group(function(){

	Route::get('/pelaporan','Pelaporan@index' )->name('pel');
	Route::get('/pelaporan/map/{tw?}','Pelaporan@map' )->name('pel.map');

	Route::get('/pelaporan/detail-data/{kode_daerah}/{tw?}','Pelaporan@detail_data' )->name('pel.detail.data');


	Route::get('/realisasi/nasional/','RelNasional@index' )->name('rel.nas');
	Route::get('/realisasi/nasional/perbidang/{tw?}','RelNasional@perbidang' )->name('rel.nas.bidang');

	Route::get('/realisasi/daerah/provinsi-perbidang','RelProvinsi@perbidang' )->name('rel.pro.bidang');



	Route::get('/realisasi/daerah/provinsi/{tw?}','RelProvinsi@index' )->name('rel.daerah.pro');
	Route::get('/realisasi/daerah/provinsi-kota/{tw?}','RelDaerah@index' )->name('rel.daerah.kota');

	Route::get('/realisasi/daerah/provinsi-sanitasi/','BIDANG\Sanitasi@index' )->name('f.sanitasi');


});