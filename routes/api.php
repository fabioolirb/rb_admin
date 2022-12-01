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




//Route::resource('estoques', App\Http\Controllers\API\estoqueAPIController::class);


Route::resource('matrizs', App\Http\Controllers\API\matrizAPIController::class);


Route::resource('celulas', App\Http\Controllers\API\celulaAPIController::class);
