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

Route::get('/tournaments', 'TournamentController@index');
Route::get('/tournaments/{tournament}', 'TournamentController@show');

Route::get('/groups', 'GroupController@index');
Route::get('/groups/{group}', 'GroupController@show');

Route::get('/eliminations', 'EliminationController@index');
Route::get('/eliminations/{elimination}', 'EliminationController@show');

Route::get('/matches', 'MatchController@index');
Route::get('/matches/{match}', 'MatchController@show');

Route::get('/teams', 'TeamController@index');
Route::get('/teams/{team}', 'TeamController@show');

Route::get('/players', 'PlayerController@index');
Route::get('/players/{player}', 'PlayerController@show');