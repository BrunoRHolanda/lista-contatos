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

/**
 * Rotas com controles do laravel.
 *
 */
Route::get('/', 'SinglePageApplicationController@vue')->name('home');

// deixar essa rota sempre em último (rotas gerais para o vue)
Route::get('{any}', 'SinglePageApplicationController@vue')->where('any', '.*');
