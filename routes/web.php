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
    return view('school.index');
});

/* API URL */
Route::post('/platform/login', 'AuthController@login');
Route::get('/platform/getHomeDatas', 'PlatformFrontController@home');
Route::resource('/qcm', 'QcmController', ['except' => ["create", "edit"]]);
/////////////

Route::any('/platform', function(){
    return view('platform.index');
});

Route::any('/platform/{path?}', function(){
    return view('platform.index');
});

Route::any('/platform/{path?}/{act?}', function(){
    return view('platform.index');
});

Route::any('/platform/{path?}/{act?}/{id?}', function(){
    return view('platform.index');
});

Route::any('/{path?}', function() {
    return view('school.error');
});
