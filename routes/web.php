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
Route::get('/demo','Rss\RssfeedController@demo');
Route::get('/updateRssFeeds','Rss\RssfeedController@updateRssFeeds');
Route::get('/updateFeeds','Rss\RssfeedController@updateFeeds');

Route::group(['prefix' => 'api-details'],function (){
    Route::get('/','ApiPanelController@index');
    Route::get('/register-form','ApiPanelController@registerForm');
    Route::get('/getAllCategories','ApiPanelController@getAllCategories');
    Route::get('/login-form','ApiPanelController@loginForm');
    Route::get('/getnewsByCategoriesId','ApiPanelController@getnewsByCategoriesId');
    Route::get('/getnewsLikesComment','ApiPanelController@getnewsLikesComment');
    Route::get('/likeNews','ApiPanelController@likeNews');
    Route::get('/commentOnNews','ApiPanelController@commentOnNews');
    Route::get('/bookmarkNews','ApiPanelController@bookmarkNews');
    Route::get('/deleteComment','ApiPanelController@deleteComment');
    Route::get('/deleteBookmark','ApiPanelController@deleteBookmark');
    Route::get('/getAllBokkmarkNews','ApiPanelController@getAllBokkmarkNews');

});


Route::get('/test',function (){

    Mail::to('pankajkachhwaye@gmail.com')->send(new \App\Mail\TestMail());
});



