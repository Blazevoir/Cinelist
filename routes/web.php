<?php

use Illuminate\Support\Facades\Route;

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

//redirect del index
Route::get('/', 'IndexController@index');
//Verificacion del Email
Route::get('verifyemail/{token}', 'IndexController@verify');
//Buscador para guardar, ahora mismo está inactiva desde la web.
Route::post('/search', 'SearchController@search');
Route::post('/savesearch', 'IndexController@search');
Route::post('/search/casting', 'SearchController@searchCasting');
Route::post('/postreview', 'ReviewController@crearReview');
//Rutas de Auth
Auth::routes();
//Rutas de Twitter API
Route::get('/redirect', 'SocialAuthTwitterController@redirect');
Route::get('/callback', 'SocialAuthTwitterController@callback');

//Home
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id}', 'ProfileController@index');

//Singles
Route::get('/actors/', 'ActorController@index');
//Reset de contraseña
Route::post('/forgot', 'ForgotController@forgot');
Route::get('/forgot/password', 'ForgotController@password');
Route::post('forgot/password/set', 'ForgotController@setPassword');
//Invitar a un usuario
Route::post('/invite', 'InviteController@invite');
Route::get('/invite/register' ,'InviteController@registerview');
//contacto
Route::get('/contact', 'ContactController@contact');
Route::post('/contact/form', 'ContactController@contactForm');
//review
Route::post('/review/{idmedia}','ReviewController@reviewList');
Route::post('/deletereview','ReviewController@deleteReview');
Route::post('/changeProfile','ProfileController@changeProfile');
//viewall de profile
Route::post('/profile/{id}/all', 'ProfileController@allmedia');
//Discover
Route::any('/discover', 'DiscoverController@discover');
//Fallback, con excepcion de mediacontroller que tiene que ir abajo
Route::get('/{media}/{idmovie}', 'MediaController@index');
Route::fallback('FallbackController@fallback');

