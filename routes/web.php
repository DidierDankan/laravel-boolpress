<?php

use Illuminate\Support\Facades\Route;
use Illuminate\support\Facades\Auth;

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
    return view('guest.welcome');
});

Auth::routes();

//Route::get('/admin', 'HomeController@index')->name('home');

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->name('admin.')
        ->group(function(){
            //route home admin
            Route::get('/', 'HomeController@index')->name('home');

            //route resource posts
            Route::resource('/posts', 'PostController');
        });
