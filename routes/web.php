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

/** ROUTE LARAVEL BASE **/
Route::get('/', 'FrontController@index');
Route::get('/contact', 'FrontController@contact');
Route::get('/lycée', 'FrontController@lycee');
Route::get('/mention-legales', 'FrontController@mlegales');
Route::get('/actualités', 'FrontController@actus');
///////////////////////////////

/* API URL */
Route::resource('/post', 'PostController', ['except' => ["create"]]);
Route::resource('/qcm', 'QcmController', ['except' => ["create"]]);
Route::post('/qcm/student', 'QcmController@getAllFromStudent');
Route::post('/qcm/addScore', 'QcmController@addScore');
Route::post('/platform/login', 'AuthController@login');
Route::post('/platform/getStudentHomeDatas', 'PlatformFrontController@homeStudent');
Route::get('/platform/getHomeDatas', 'PlatformFrontController@home');
Route::get('/students', 'PlatformFrontController@students');

/////////////

/** ROUTE TO ANGULAR **/
Route::any('/platform/{path?}/{act?}/{id?}', function(){
    return view('platform.index');
});
///////////////////////////

//ERREUR 404
Route::any('/{path?}', function() {
    return view('school.parts.error');
});
