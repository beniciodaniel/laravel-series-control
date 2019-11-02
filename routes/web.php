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
App\Http\Middleware\Authenticate::class;

Route::get('/', 'WelcomeController@index');

Route::get('/series', 'SeriesController@index')
    ->name('series.index');

Route::get('/series/create', 'SeriesController@create')
    ->name('series.create')
    ->middleware('autenticador');

Route::post('/series/create', 'SeriesController@store')
    ->middleware('autenticador');

Route::post('/series/{id}', 'SeriesController@destroy')
    ->middleware('autenticador');

Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistidos', 'EpisodiosController@assistidos')
    ->middleware('autenticador');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index')->name('entrar');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create')->name('registrar');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('entrar');
});