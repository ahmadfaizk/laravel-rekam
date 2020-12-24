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
    //return view('welcome');
    return redirect()->route('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/provinsi', 'ProvinsiController@index');
    Route::get('/provinsi/{id}', 'ProvinsiController@show');
    Route::get('/kabupaten/{id}', 'KabupatenController@show');
    Route::resource('makam', 'MakamController');
});