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

    //! Route Admin
    Route::prefix('admin')->group(function() {

        //! Users Setting
        Route::get('/user-setting', 'Admin\UserController@index')->name('user.index'); 
        Route::get('/user-setting/{id}', 'Admin\UserController@show');
        Route::get('/user-json', 'Admin\UserController@user_json'); 
    }); 
