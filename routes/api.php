<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('getmovies', 'DevController@getmovies');
Route::post('saveSingle', 'SaveController@saveSingle');

Route::post('saveEpisode', 'SaveController@saveEpisode');
Route::post('deleteEpisode', 'SaveController@deleteEpisode');

Route::post('saveSeason', 'SaveController@saveSeason');
Route::post('deleteSeason', 'SaveController@deleteSeason');

Route::post('addFavorite', 'SaveController@addFavorite');
Route::post('deleteFavorite', 'SaveController@deleteFavorite');

Route::post('addMediaToList', 'SaveController@addMediaToList');

//METODOS DE CHECK PARA SINGLE

Route::post('checkEpisode', 'CheckController@checkEpisode');
Route::post('checkSeason', 'CheckController@checkSeason');
Route::post('checkFavorite', 'CheckController@checkFavorite');
Route::post('checkSelect', 'CheckController@checkSelect');
Route::post('checkUserLogin', 'TwitterController@checkUserLogin');

//metodo de report para review
Route::post('reportreview', 'ReviewController@report');
 
//votos
Route::post('positiveVote', 'ReviewController@positive');
Route::post('negativeVote', 'ReviewController@negative');
Route::post('removePositive', 'ReviewController@removePositive');
Route::post('removeNegative', 'ReviewController@removeNegative');

Route::post('setScore', 'ScoreController@setScore');
Route::post('checkScore', 'ScoreController@checkScore');
//METODOS DE CHECK PARA INDES
Route::post('checkTrendingFavorites', 'CheckController@checkTrendingFavorites');
Route::post('checkVotes', 'ReviewController@checkVotes');

//twitter
Route::post('tuitVago', 'TwitterController@tuitvago');
Route::post('tuitMedia', 'TwitterController@tuitMedia');

