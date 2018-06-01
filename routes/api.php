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
    Route::post('getsalas', ['uses' => 'Api\ApiController@obtenerSalas']);
    Route::post('getdias', ['uses' => 'Api\ApiController@obtenerDias']);
    Route::post('addreserva', ['uses' => 'Api\ApiController@agregarReserva']);
    Route::post('getreservassala', ['uses' => 'Api\ApiController@obtenerReservasPorSala']);
    Route::post('getdiasemana', ['uses' => 'Api\ApiController@obtenerDiaSemana']);
    Route::post('getresdiasal', ['uses' => 'Api\ApiController@obtenerReservasPorSalaDia']);
});

Route::group(['prefix' => 'get', 'middleware' => 'auth:api'], function () {

});