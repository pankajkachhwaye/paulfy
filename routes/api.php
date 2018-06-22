<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::group(['namespace' => 'Api',],function (){
    Route::post('/register','UserController@register');
    Route::post('/login','UserController@login');
    Route::get('/getAllCategories','RssfeedApiController@getAllCategories');
    Route::post('/getAllCategories','RssfeedApiController@getAllCategories');
    Route::post('/getnewsByCategoriesId','RssfeedApiController@getnewsByCategoriesId');
    Route::post('/getnewsLikesComment','RssfeedApiController@getnewsLikesComment');
    Route::post('/likeNews','RssfeedApiController@likeNews');
    Route::post('/dislikeNews','RssfeedApiController@dislikeNews');

    Route::post('/replyOnComment','RssfeedApiController@replyOnComment');
    Route::post('/commentNews','RssfeedApiController@commentNews');
    Route::post('/upvoteOnComment','RssfeedApiController@upvoteOnComment');
    Route::post('/deleteCommentNews','RssfeedApiController@deleteCommentNews');

    Route::post('/bookmarkNews','RssfeedApiController@bookmarkNews');
    Route::post('/getAllBokkmarkNews','RssfeedApiController@getAllBokkmarkNews');
    Route::post('/deleteBookmarks','RssfeedApiController@deleteBookmarks');

    Route::post('/hideunhideNews','RssfeedApiController@hideunhideNews');
    Route::post('/getAllHideNews','RssfeedApiController@getAllHideNews');

    Route::post('/forgetPassword','RssfeedApiController@forgetPassword');
    Route::post('/checkEmail','RssfeedApiController@checkEmail');



});