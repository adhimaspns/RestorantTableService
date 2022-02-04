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
        return view('layouts.admin.app');
    });

    //! AUTH
    Route::get('register', 'AuthController@register'); 
    Route::post('register', 'AuthController@proses_login');

    //! Route Admin
    Route::prefix('admin')->group(function() {

        //! Users Setting
        Route::get('/user-setting', 'Admin\UserController@index')->name('user.index'); 
        Route::get('/user-setting/{id}', 'Admin\UserController@show');
        Route::get('/user-nonaktif/{id}', 'Admin\UserController@user_nonaktif');
        Route::get('/user-json', 'Admin\UserController@user_json'); 

        //! Meja
        Route::get('/meja-setting', 'Admin\MejaController@index'); 
        Route::get('meja-json', 'Admin\MejaController@meja_json');
    }); 
