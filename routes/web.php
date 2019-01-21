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
    return view('home');
})->name('home');

Route::get('/team/{id}', function($id){
    return view('team_detail')->with(['team_id' => $id]);
})->where('id', '[0-9]+')->name('team_detail');

//Route::get('/team/{id}','TeamController@showDetailView')->where('id', '[0-9]+');