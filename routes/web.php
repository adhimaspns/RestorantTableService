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

    Route::get('/', 'AppController@index');

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

        //! Menu
        Route::get('menu/makanan', 'Admin\MenuController@index')->name('menu.index'); 
        Route::get('makanan-json', 'Admin\MenuController@makanan_json');
        Route::post('menu/makanan', 'Admin\MenuController@makanan_store');
        Route::get('menu/makanan/{id}/detail', 'Admin\MenuController@show');
        Route::get('menu/makanan/{id}/edit', 'Admin\MenuController@edit');
        Route::patch('menu/makanan/{id}', 'Admin\MenuController@update');

        Route::get('menu/minuman', 'Admin\MenuController@index_minuman');
        Route::get('minuman-json', 'Admin\MenuController@minuman_json');
        Route::post('menu/minuman', 'Admin\MenuController@minuman_store');
        Route::get('menu/minuman/{id}/detail', 'Admin\MenuController@show_minuman');
        Route::get('menu/minuman/{id}/edit', 'Admin\MenuController@edit_minuman');
        Route::patch('menu/minuman/{id}', 'Admin\MenuController@update_minuman');

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
        Route::get('booking/menunggu-persetujuan', 'Admin\BookingController@persetujuan');
        Route::get('persetujuan-json', 'Admin\BookingController@persetujuan_json');
        Route::get('booking/menunggu-persetujuan/{no_transaksi}/detail', 'Admin\BookingController@persetujuan_detail');
        Route::get('persetujuan/{no_transaksi}/{status}', 'Admin\BookingController@persetujuan');
        Route::get('booking/menunggu-pembayaran', 'Admin\BookingController@pembayaran');
        Route::get('pembayaran-json', 'Admin\BookingController@pembayaran_json');
        Route::get('booking/menunggu-pembayaran/{no_transaksi}/detail', 'Admin\BookingController@pembayaran_detail');
        Route::get('booking-json', 'Admin\BookingController@booking_json');
        Route::get('booking/sukses', 'Admin\BookingController@booking_sukses');
        Route::get('booking-sukses-json', 'Admin\BookingController@booking_sukses_json');

        //! Laporan
        Route::get('laporan', 'Admin\LaporanController@index');
        Route::get('laporan-json', 'Admin\LaporanController@laporan_json');
        Route::post('proses-laporan-by-date', 'Admin\LaporanController@proses_laporan_by_date');
        Route::get('laporan/cetak-laporan', 'Admin\LaporanController@cetak_laporan');
        Route::get('laporan/{no_transaksi}/detail', 'Admin\LaporanController@detail');
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

        //! Booking
        Route::get('booking', 'BookingController@index'); 

        //! Menu
        Route::get('pesan-menu/{no_transaksi}', 'MenuController@checkout'); 
        Route::post('pesan-menu/proses/{kategori}/{no_transaksi}', 'MenuController@proses_pesan_menu');
        Route::get('pesan-menu/checkout/{no_transaksi}', 'MenuController@checkout_akhir');
    }); 

