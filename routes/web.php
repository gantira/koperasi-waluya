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
Route::get('login', ['as' => 'login', 'uses' => 'LoginController@index']);
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::get('formreset', 'LoginController@formreset');
Route::post('reset', 'LoginController@reset');
Route::post('newpassword', 'LoginController@newpassword');

Route::get('/', 'DashboardController@index');

Route::get('/404', function () {
    return view('404');
});

Route::middleware(['auth'])->group(function () {
    Route::get('simpanan', function () {
   		return view('simpanan.index');
	});

	Route::get('pinjaman', function () {
	    return view('pinjaman.index');
	});

	Route::get('transaksi', function () {
	    return view('transaksi.index');
	});
});

Route::get('akun/kategori', 'KategoriController@index');
Route::get('rit/perahu/{nomor}', 'RitController@show_perahu');
Route::get('rit/cek/{rit}', 'RitController@cek');
Route::resource('rit', 'RitController');
Route::resource('kategori', 'KategoriController');
Route::resource('akun', 'AkunController');
Route::get('akun/{akun}/active', 'AkunController@active');
Route::resource('anggota', 'AnggotaController', ['parameters' => ['anggota' => 'anggota']]);
Route::get('anggota/{anggota}/active', 'AnggotaController@active');
Route::resource('wajib', 'WajibController');
Route::resource('pokok', 'PokokController');
Route::resource('manasuka', 'ManasukaController');
Route::resource('setting', 'SettingController');
Route::resource('angsuran', 'AngsuranController');
Route::resource('angsuranDetail', 'AngsuranDetailController');
Route::resource('kilat', 'KilatController');
Route::resource('kilatDetail', 'KilatDetailController');
Route::resource('pendapatan', 'PendapatanController');
Route::resource('pengeluaran', 'PengeluaranController');

Route::get('laporan', 'LaporanController@index');
Route::get('laporan/anggota', 'LaporanController@anggota');
Route::get('laporan/rit', 'LaporanController@rit');
Route::get('laporan/keuangan', 'LaporanController@keuangan');
Route::get('laporan/keuangan/labarugi', 'LaporanController@labarugi');
Route::get('laporan/keuangan/labarugi/perbulan', 'LaporanController@labarugi_bulan');
Route::get('laporan/keuangan/pengeluaran', 'LaporanController@pengeluaran');
Route::get('laporan/print/export', 'LaporanController@export');