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

/*Route::get('/', function () {
    return view('auth.login');
});*/

Route::prefix('')->group(function(){
Route::middleware('guest')->group(function(){
Route::get('/login','AuthenticateController@showLogin')->name('login');
Route::post('/auth','AuthenticateController@authProcess')->name('auth');
});
});

Route::prefix('admin')->group(function(){
Route::middleware('auth')->group(function(){
Route::get('/','AdminController@index')->name('admin.dashboard');
Route::get('/logout','AuthenticateController@logout')->name('admin.logout');
});
});