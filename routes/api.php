<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'post', 'middleware' => 'auth:api'], function () {
    Route::post('sessions', ['uses' => 'Api\ApiController@actualizarFechaComputador']);
    Route::post('updatestates', ['uses' => 'Api\ApiController@actualizarEstados']);
    Route::post('getpcsbysala', ['uses' => 'Api\ApiController@obtenerComputadores']);
});

Route::group(['prefix' => 'get', 'middleware' => 'auth:api'], function () {
	Route::get('getpcs', ['uses' => 'Api\ApiController@getpcstotales']);
});