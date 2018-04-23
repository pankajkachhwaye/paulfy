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
    return view('welcome');
});


Route::group(['prefix' => 'api-details'],function (){
    Route::get('/','ApiPanelController@index');
    Route::get('/register-form','ApiPanelController@registerForm');
    Route::get('/login-form','ApiPanelController@loginForm');
});


Route::get('/test',function (){

    Mail::to('pankajkachhwaye@gmail.com')->send(new \App\Mail\TestMail());
});
