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

//Team Detail
Route::get('/team/{id}', function($id){
    return view('team_detail')->with(['team_id' => $id]);
})->where('id', '[0-9]+')->name('team_detail');

//Create Player
Route::get('/player/create', function(){
    return view('player_create_edit')->with(['player_id' => null]);
});

//Edit Player
Route::get('/player/{id}/edit', function($id){
    return view('player_create_edit')->with(['player_id' => $id]);
})->where('id', '[0-9]+');

//Create Team
Route::get('/team/create', function(){
    return view('team_create_edit')->with(['team_id' => null]);
});

////Edit Team
//Route::get('/team/{id}/edit', function($id){
//    return view('team_create_edit')->with(['team_id' => $id]);
//})->where('id', '[0-9]+');

