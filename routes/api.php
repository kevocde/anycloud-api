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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::apiResources([
        'clouds' => 'CloudController',
        'cloud-types' => 'CloudTypeController',
        'drivers' => 'DriverController'
    ]);

    // Listado recursivo de los archivos
    Route::get('/drivers/{driver}/files/{entities?}', 'FileController@index')
        ->where('entities', '^[0-9\/]+$')
        ->name('files.index')
    ;

    // Creación de carpeta o carga de archivo a directorio
    Route::post('/drivers/{driver}/files/{entities?}', 'FileController@store')
        ->where('entities', '^[0-9\/]+$')
        ->name('files.store')
    ;
});
