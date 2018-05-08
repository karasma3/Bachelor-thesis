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
Route::get('/tournaments/create', 'TournamentController@create');
Route::post('/tournaments', 'TournamentController@store');
Route::get('/tournaments/{tournament}', 'TournamentController@show');
Route::post('/tournaments/{tournament}/change_tournament_name', 'TournamentController@changeTournamentName');
Route::get('/tournaments/{tournament}/edit', 'TournamentController@edit');
Route::get('/tournaments/{tournament}/generate_groups', 'TournamentController@generateGroups');
Route::get('/tournaments/{tournament}/create_bracket', 'TournamentController@createBracket');
Route::get('/tournaments/{tournament}/next_round', 'TournamentController@nextRound');
Route::get('/tournaments/{tournament}/calculate_score', 'TournamentController@calculateScore');
Route::get('/tournaments/{tournament}/join', 'TournamentController@join');
Route::post('/tournaments/{tournament}/join', 'TournamentController@addTeam');

Route::get('/groups', 'GroupController@index');
Route::get('/groups/{group}', 'GroupController@show');

Route::get('/matches', 'MatchController@index');
Route::get('/matches/{match}', 'MatchController@show');
Route::patch('/matches/{match}', 'MatchController@submitScore');
Route::get('/matches/{match}/edit', 'MatchController@edit');

Route::get('/teams', 'TeamController@index');
Route::get('/teams/create', 'TeamController@create');
Route::post('/teams', 'TeamController@store');
Route::get('/teams/{team}', 'TeamController@show');
Route::delete('/teams/{team}', 'TeamController@destroy');
Route::get('/teams/{team}/inactivate', 'TeamController@inactivateTeam');
Route::get('/teams/{team}/edit', 'TeamController@edit');
Route::get('/teams/{team}/delete', 'TeamController@delete');
Route::post('/teams/{team}/change_team_name', 'TeamController@changeTeamName');
Route::post('/teams/{team}/add_player', 'TeamController@addPlayer');

Route::get('/players', 'PlayerController@index');
Route::get('/players/{player}', 'PlayerController@show');
Route::patch('/players/{player}', 'PlayerController@editPlayer');
Route::patch('/players/{player}/password', 'PlayerController@changePassword');
Route::get('/players/{player}/edit', 'PlayerController@edit');

Route::get('/register', 'AuthController@register');
Route::post('/register', 'AuthController@storeRegister');
Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@storeLogin');
Route::get('/logout', 'AuthController@logout');