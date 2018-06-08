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


//Operator Routes
Route::resource('/admin/broadcast','BroadcastController');
Route::get('admin/broadcast/delete/{id}','BroadcastController@destroy');
// Route::get('admin/broadcast/finish','BroadcastController@finish');
Route::resource('/admin/content','ContentController');
Route::get('admin/content/delete/{id}','ContentController@destroy');
Route::get('admin/content/download/{id}','ContentController@download');

Route::resource('/admin/barang','BarangController');
Route::get('admin/barang/delete/{id}','BarangController@destroy');

Route::resource('/admin/pembelian','PembelianController');
Route::get('admin/pembelian/delete/{id}','PembelianController@destroy');

//Head Admin Routes
Route::resource('/headadmin/broadcast','HeadbroadcastController');
Route::get('headadmin/broadcast/delete/{id}','HeadbroadcastController@destroy');
Route::resource('/headadmin/content','HeadcontentController');
Route::resource('/headadmin/users','MitraController');
Route::get('headadmin/users/delete/{id}','MitraController@destroy');


//Mitra Routes
Route::resource('mitra/datapembelian','DatapembelianController');
Route::resource('mitra/barang','MitrabarangController');
Route::get('mitra/barang/delete/{id}','MitrabarangController@destroy');
Route::resource('mitra/resi','ResiController');
Route::get('mitra/print/{id}','DatapembelianController@print');

//Konsumen pembelian
Route::resource('pembelian','KonsumenbeliController');

Route::get('whitening', function () {
    return view('beautyskywhiteningseries');
});

Route::resource('test','TestajaController');

Route::get('/send/email', 'HomeController@mail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('error',function(){
  return view('404');
});
