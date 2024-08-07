<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\MasukanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\InvoiceCetakController;

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
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', 'ProductController@index');
        Route::get('/new', 'ProductController@create');
        Route::get('/{id}', 'ProductController@edit');
        Route::put('/{id}', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@destroy');
        Route::post('/', 'ProductController@save');
    });

    Route::group(['prefix' => 'customer'], function() {
        Route::get('/', 'CustomerController@index');
        Route::get('/new', 'CustomerController@create');
        Route::post('/', 'CustomerController@save');
        Route::get('/{id}', 'CustomerController@edit');
        Route::put('/{id}', 'CustomerController@update');
        Route::delete('/{id}', 'CustomerController@destroy');
    });

    Route::group(['prefix' => 'invoice'], function() {
        Route::get('/', 'InvoiceController@index')->name('invoice.index');
        Route::get('/new', 'InvoiceController@create')->name('invoice.create');
        Route::post('/', 'InvoiceController@save')->name('invoice.store');
        Route::get('/{id}', 'InvoiceController@edit')->name('invoice.edit');
        Route::put('/{id}', 'InvoiceController@update')->name('invoice.update');
        Route::delete('/{id}', 'InvoiceController@deleteProduct')->name('invoice.delete_product');
        Route::delete('/{id}/delete', 'InvoiceController@destroy')->name('invoice.destroy');
    });

    Route::get('/cetak/{id}', 'InvoiceCetakController@cetakPDF')->name('cetak');

    Route::group(['prefix' => 'masukan'], function() {
        Route::get('/', 'MasukanController@index');
        Route::get('/new', 'MasukanController@create');
        Route::get('/{id}', 'MasukanController@edit');
        Route::put('/{id}', 'MasukanController@update');
        Route::delete('/{id}', 'MasukanController@destroy');
        Route::post('/', 'MasukanController@save');
    });

    Route::group(['prefix' => 'laporan'], function() {
        Route::get('/', 'LaporanController@index')->name('laporan.index');
    });

    Route::group(['prefix' => 'data_user'], function() {
        Route::get('/', 'DataUserController@index')->name('data_user.index');
        Route::get('/new', 'DataUserController@create');
        Route::get('/{id}', 'DataUserController@edit');
        Route::put('/{id}', 'DataUserController@update');
        Route::delete('/{id}', 'DataUserController@destroy');
        Route::post('/', 'DataUserController@save');
    });

    // Rute untuk role 'admin'
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('home/admin', AdminController::class);
    });

    // Rute untuk role 'keuangan'
    Route::group(['middleware' => ['role:keuangan']], function () {
        Route::resource('home/keuangan', KeuanganController::class);
    });

    // Rute untuk role 'direktur'
    Route::group(['middleware' => ['role:direktur']], function () {
        Route::resource('home/direktur', DirekturController::class);
    });
});
