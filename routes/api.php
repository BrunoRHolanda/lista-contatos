<?php

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'v1'

], function () {

    Route::apiResources([

        'users' => 'Api\V1\UserController',
        'contacts' => 'Api\V1\ContactsController',

    ]);

    Route::get('contacts/search/{text}', 'Api\V1\ContactsController@search');

    Route::get('login',

        function () {
            return response()->json(['error' => 'Usuário não autenticado', 401]);
        }

    )->name('login');
});
