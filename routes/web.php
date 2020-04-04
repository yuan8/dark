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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/pilih-tahun', 'INIT\InitialTahunCtrl@front_pilih_tahun')->name('f.pilih_tahun');
Route::post('/pilih-tahun', 'INIT\InitialTahunCtrl@store_front_pilih_tahun')->name('f.pilih_tahun.store');



Route::get('/pelaporan','Pelaporan@index' )->name('pel');
Route::get('/pelaporan/detail-data/{kode_daerah}','Pelaporan@detail_data' )->name('pel.detail.data');


Route::get('/realisasi/nasional/','RelNasional@index' )->name('rel.nas');
