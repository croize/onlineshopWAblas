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
    return redirect('acneseries');
});

Route::get('/acneseries/{y}', function ($y) {
    return view('welcome',compact('y'));
});

Route::get('/acneseries', function () {
    return view('nonreselleracne');
});

Route::get('export', function () {
    return \Excel::download(new App\Exports\PembelianExport, 'invoices.xlsx');
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
Route::put('admin/pembelian/pembayaran/{bayar}','PembelianController@bayar');



//Head Admin Routes

// Broadcast Headadmin
Route::get('headadmin','HeadadminController@index');
Route::resource('/headadmin/broadcast','HeadbroadcastController');
Route::get('headadmin/broadcast/delete/{id}','HeadbroadcastController@destroy');

// Content Headadmin
Route::resource('/headadmin/content','HeadcontentController');

// Mitra Account Manage Headadmin
Route::resource('/headadmin/users','MitraController');
Route::get('headadmin/users/delete/{id}','MitraController@destroy');

// Reseller Account Manage Headadmin
Route::get('headadmin/reseller','ResellermanageController@index');
Route::put('headadmin/reseller/accept/{id}','ResellermanageController@accept');
Route::put('headadmin/reseller/denied/{id}','ResellermanageController@denied');

// Reseller keuangan manage headadmin
Route::get('headadmin/keuangan','ResellermanageController@pendatapan');
Route::put('headadmin/reseller/dana/accept/{id}','ResellermanageController@acceptpengambilan');

// Mitra Link Headadmin
Route::get('headadmin/listlink','ListlinkController@index');
Route::get('headadmin/listlink/create','ListlinkController@create');
Route::post('headadmin/listlink/store','ListlinkController@store');
Route::get('headadmin/listlink/edit/{id}','ListlinkController@edit');
Route::put('headadmin/listlink/update/{id}','ListlinkController@update');
Route::get('headadmin/listlink/delete/{id}','ListlinkController@destroy');
//END OF HEADADMIN CONTROLLER



//Mitra Routes
Route::resource('mitra/datapembelian','DatapembelianController');
Route::resource('mitra/barang','MitrabarangController');
Route::get('mitra/barang/delete/{id}','MitrabarangController@destroy');
Route::resource('mitra/resi','ResiController');
Route::get('mitra/print/{id}','DatapembelianController@print');

Route::get('http://107.20.199.106/api/v3/sendsms/plain?user=SMS_Instan1&password=instansms&sender=SMS%20INSTAN&SMSText=testing+USER+Telkomsel+with+webapi+user+smsinstan&GSM=6282116620263', function () {
  return redirect('/');
});

//Konsumen pembelian
Route::get('pembelian','KonsumenbeliController@index');
Route::get('pembelian/{mobsterid}','KonsumenbeliController@indexreseller');
Route::post('pembelian/store/{mobsterid}','KonsumenbeliController@store');
Route::post('pembelian/store','KonsumenbeliController@storenon');

//Reseller
Route::get('reseller','ResellerController@index');
Route::put('reseller/active/{id}', 'ResellerController@active');
Route::put('reseller/setting/profile/{id}', 'ResellerController@accountprofile');
Route::put('reseller/setting/password/{id}', 'ResellerController@accountpassword');
Route::put('reseller/salary/{id}', 'ResellerController@salary');
Route::get('reseller/order','ResellerController@order');

Route::get('whitening/{x}', function ($x) {
    return view('beautyskywhiteningseries',compact('x'));
});
Route::get('whitening', function () {
    return view('whiteningnonreseller');
});

// //BUAT GENERATE ACTIVITY
// Route::get('booking/create','BookingController@create');
// Route::post('booking/store','BookingController@store');

Route::resource('test','TestajaController');

Route::get('/send/email', 'HomeController@mail');

Route::get('cpanel', function () {
    return redirect('/');
});

Route::get('sms/{linkfrom}/{phone}/{isisms}/{iduser}','SmsController@send');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('error',function(){
  return view('404');
});
