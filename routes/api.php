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

// list anime

Route::get('anime','AnimeController@index');

//list single anime
Route::post('anime','AnimeController@show');
// Create new article
Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('get-details', 'API\PassportController@getDetails');
});
Route::group(['middleware' => 'auth:api'], function(){
	Route::post('like','AnimeController@like');

});
Route::group(['middleware' => 'auth:api'], function(){
	Route::post('likes','AnimeController@uplikes');

});
