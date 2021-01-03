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
    return redirect()->route('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/reset', 'HomeController@reset');
    Route::get('/provinsi', 'ProvinsiController@index');
    Route::get('/provinsi/{id}', 'ProvinsiController@show');
    Route::get('/kabupaten/{id}', 'KabupatenController@show');
    Route::resource('makam', 'MakamController');
    Route::get('marketplace', 'MarketplaceController@index')->name('marketplace.index');
    Route::get('marketplace/{id}', 'MarketplaceController@show')->name('marketplace.show');
    Route::get('marketplace/{id}/buy', 'MarketplaceController@buy')->name('marketplace.buy');
    Route::get('transaksi', 'TransaksiController@index')->name('transaksi.index');
    Route::post('transaksi', 'TransaksiController@store')->name('transaksi.store');
    Route::get('transaksi/{id}', 'TransaksiController@show')->name('transaksi.show');
    Route::get('transaksi/{id}/print', 'TransaksiController@print')->name('transaksi.print');
    Route::post('transaksi/confirm', 'TransaksiController@confirm')->name('transaksi.confirm');
    Route::post('transaksi/confirm-pembayaran', 'TransaksiController@confirmPembayaran')->name('transaksi.confirm-pembayaran');
});