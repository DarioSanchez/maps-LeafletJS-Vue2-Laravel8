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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v01/stations/')->group(function () {
    Route::get('list', [\App\Http\Controllers\ListStationController::class, '__invoke']);
    Route::get('listAll', [\App\Http\Controllers\ListAllStationController::class, '__invoke']);
    Route::get('localization', [\App\Http\Controllers\LocalizationStationController::class, '__invoke']);
    Route::get('localizationId/{id}', [\App\Http\Controllers\LocalizationIdStationController::class, '__invoke']);
    Route::get('detail/{id}', [\App\Http\Controllers\DetailStationController::class, '__invoke']);

});
