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
Route::get('/', function () {
    return view('school.index');
});
///////////////////////////////

/* API URL */
Route::resource('/qcm', 'QcmController', ['except' => ["create"]]);
Route::post('/qcm/addScore', 'QcmController@addScore');
Route::resource('/post', 'PostController', ['except' => ["create"]]);
Route::post('/platform/login', 'AuthController@login');
Route::get('/platform/getHomeDatas', 'PlatformFrontController@home');
Route::post('/platform/getStudentHomeDatas', 'PlatformFrontController@homeStudent');
Route::post('/getScoreFromQcm', 'PlatformFrontController@scoreFromIds');
/////////////

/** ROUTE TO ANGULAR **/
Route::any('/platform/{path?}/{act?}/{id?}', function(){
    return view('platform.index');
});
///////////////////////////

//ERREUR 404
Route::any('/{path?}', function() {
    return view('school.error');
});
