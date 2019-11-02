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

use Illuminate\Support\Facades\Route;

Route::get('/', 'WelcomeController@index');

Route::get('/series', 'SeriesController@index')
    ->name('series.index')
    ->middleware('auth');

Route::get('/series/create', 'SeriesController@create')->name('series.create');
Route::post('/series/create', 'SeriesController@store');
Route::post('/series/{id}', 'SeriesController@destroy');

Route::post('/series/{id}/editaNome', 'SeriesController@editaNome');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistidos', 'EpisodiosController@assistidos');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index')->name('entrar');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('entrar');
});