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


Route::post('/searchConductor',  'Apis\ConexionCondController@searchConductor');
Route::post('/insertRecarga',    'Apis\ApiRecargaController@insertRecarga');
Route::get('/getRecargasLast',   'Apis\ApiRecargaController@getRecargasLast');
Route::get('/getRecargasDate',   'Apis\ApiRecargaController@getRecargasDate');


Route::group(['middleware' => 'keyapi'], function () {

});
