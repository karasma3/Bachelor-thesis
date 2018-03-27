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
}) -> name('home');

Route::get('/tournaments', 'TournamentController@index');
Route::get('/tournaments/{tournament}', 'TournamentController@show');

Route::get('/groups', 'GroupController@index');
Route::get('/groups/{group}', 'GroupController@show');

Route::get('/eliminations', 'EliminationController@index');
Route::get('/eliminations/{elimination}', 'EliminationController@show');

Route::get('/matches', 'MatchController@index');
Route::get('/matches/{match}', 'MatchController@show');
Route::get('/matches/{match}/edit', 'MatchController@edit');

Route::get('/teams', 'TeamController@index');
Route::get('/teams/create', 'TeamController@create');
Route::post('/teams', 'TeamController@store');
Route::get('/teams/{team}', 'TeamController@show');
Route::get('/teams/{team}/edit', 'TeamController@edit');
Route::post('/teams/{team}/change_team_name', 'TeamController@changeTeamName');
Route::post('/teams/{team}/add_player', 'TeamController@addPlayer');

Route::get('/players', 'PlayerController@index');
Route::get('/players/{player}', 'PlayerController@show');
Route::get('/players/{player}/edit', 'PlayerController@edit');

Route::get('/register', 'AuthController@register');
Route::post('/register', 'AuthController@storeRegister');
Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@storeLogin');
Route::get('/logout', 'AuthController@logout');