<?php

use Illuminate\Support\Facades\Route;

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
        return view('app');
    });

    //! AUTH
    Route::get('login', 'AuthController@login');
    Route::post('login', 'AuthController@proses_login');
    Route::get('register', 'AuthController@register'); 
    Route::post('register', 'AuthController@proses_register');
    Route::post('logout', 'AuthController@logout');

    //! Route Admin
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'CheckRole:Kasir']], function() {

        //! Beranda
        Route::get('beranda', 'Admin\BerandaController@index'); 

        //! Users Setting
        Route::get('/user-setting', 'Admin\UserController@index')->name('user.index'); 
        Route::get('/user-setting/{id}', 'Admin\UserController@show');
        Route::get('/user-nonaktif/{id}', 'Admin\UserController@user_nonaktif');
        Route::get('/user-json', 'Admin\UserController@user_json'); 

        //! Meja
        Route::get('/meja-setting', 'Admin\MejaController@index'); 
        Route::get('meja-json', 'Admin\MejaController@meja_json');
        Route::get('/meja-off/{id}', 'Admin\MejaController@meja_off' );
        Route::post('meja-setting', 'Admin\MejaController@store');
        Route::get('meja-setting/{id}', 'Admin\MejaController@show');
        Route::get('meja-setting/{id}/edit', 'Admin\MejaController@edit');
        Route::patch('meja-setting/{id}', 'Admin\MejaController@update');

        //! Booking
        Route::get('booking', 'Admin\BookingController@index');
        Route::get('booking/lunas', 'Admin\BookingController@booking_lunas');
        Route::get('booking-lunas-json', 'Admin\BookingController@booking_lunas_json');
        Route::get('booking-json', 'Admin\BookingController@booking_json');
    }); 

    //! Route User
    Route::group(['middleware' => ['auth', 'CheckRole:Customer']], function() {

        //! Beranda
        Route::get('beranda', 'BerandaController@index'); 

        //! Checkout
        Route::get('proses-checkout/{id}', 'CheckoutController@cetak_notransaksi');
        Route::get('booking/checkout/{no_transaksi}', 'CheckoutController@booking_checkout');
        Route::post('checkout', 'CheckoutController@checkout');
        Route::get('booking/bukti-pembayaran/{no_transaksi}', 'CheckoutController@bukti_bayar');
        Route::post('booking/bukti-pembayaran/{no_transaksi}', 'CheckoutController@proses_bukti_bayar');
    }); 

