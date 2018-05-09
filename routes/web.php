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
Route::get('/tournaments/{tournament}/join', 'TournamentController@join');
Route::post('/tournaments/{tournament}/join', 'TournamentController@addTeam');

Route::group(['middleware' => ['auth', 'is_admin']], function () {
    Route::post('/tournaments/{tournament}/change_tournament_name', 'TournamentController@changeTournamentName');
    Route::get('/tournaments/{tournament}/edit', 'TournamentController@edit');
    Route::get('/tournaments/{tournament}/generate_groups', 'TournamentController@generateGroups');
    Route::get('/tournaments/{tournament}/create_bracket', 'TournamentController@createBracket');
    Route::get('/tournaments/{tournament}/next_round', 'TournamentController@nextRound');
    Route::get('/tournaments/{tournament}/calculate_score', 'TournamentController@calculateScore');
    Route::get('/tournaments/{tournament}/close', 'TournamentController@close');
});

Route::get('/groups', 'GroupController@index');
Route::get('/groups/{group}', 'GroupController@show');

Route::get('/matches', 'MatchController@index');
Route::get('/matches/{match}', 'MatchController@show');

Route::group(['middleware' => ['auth', 'match_user_edit']], function () {
    Route::patch('/matches/{match}', 'MatchController@submitScore');
    Route::get('/matches/{match}/edit', 'MatchController@edit');
});

Route::get('/teams', 'TeamController@index');
Route::get('/teams/create', 'TeamController@create');
Route::post('/teams', 'TeamController@store');
Route::get('/teams/{team}', 'TeamController@show');
Route::get('/teams/{team}/inactivate', 'TeamController@inactivateTeam');

Route::get('/players', 'PlayerController@index');
Route::get('/players/{player}', 'PlayerController@show');
Route::patch('/players/{player}', 'PlayerController@editPlayer');
Route::patch('/players/{player}/password', 'PlayerController@changePassword');
Route::get('/players/{player}/edit', 'PlayerController@edit');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');
