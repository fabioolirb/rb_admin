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


Route::resource('matrizs', \App\Http\Controllers\API\matrizAPIController::class);


Route::resource('celulas', \App\Http\Controllers\API\celulaAPIController::class);


Route::resource('ilustradors', \App\Http\Controllers\API\ilustradorAPIController::class);


Route::resource('tipo_arquivos', \App\Http\Controllers\API\tipo_arquivoAPIController::class);


Route::resource('arquivos', \App\Http\Controllers\API\arquivoAPIController::class);


Route::resource('endereco_clientes', \App\Http\Controllers\API\endereco_clienteAPIController::class);


Route::resource('clientes', \App\Http\Controllers\API\clienteAPIController::class);


Route::resource('prototipos', \App\Http\Controllers\API\prototiposAPIController::class);


Route::resource('cncs', \App\Http\Controllers\API\cncAPIController::class);


Route::resource('os_usinagems', \App\Http\Controllers\API\os_usinagemAPIController::class);

Route::get('/integracao/pedido/{orderId}', [App\Http\Controllers\OpenCartIntegrationController::class, 'showOrder'])->name('api.opencart.order.show');
