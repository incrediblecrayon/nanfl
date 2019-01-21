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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// region Team
Route::get('team','TeamController@index')->name('api-team');
Route::get('team/{id}','TeamController@show')->where('id', '[0-9]+');

Route::middleware(['auth:api'])->group(function(){
    Route::post('team','TeamController@store');
//    Route::put('team/{id}','TeamController@update')->where('id', '[0-9]+');
    Route::delete('team/{id}','TeamController@destroy')->where('id', '[0-9]+');
});
// endregion

// region Player
Route::get('player','PlayerController@index')->name('api-player');
Route::get('player/{id}','PlayerController@show')->where('id', '[0-9]+');

Route::middleware(['auth:api'])->group(function(){
    Route::post('player','PlayerController@store');
    Route::put('player/{id}','PlayerController@update')->where('id', '[0-9]+');
    Route::delete('player/{id}','PlayerController@destroy')->where('id', '[0-9]+');
});
// endregion