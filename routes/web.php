<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Auth::routes();

Route::get('/', function () {
    return redirect(route('dashboard'));
})->name('home');

Route::get('/checkOnline', function (App\Repositories\AttendanceRepository $attendanceRepo) {
    if (Auth::check()) { }
    return $attendanceRepo->CountUserOnline();
})->name('checkOnline');


//Route::get('admin/producoaos/create', 'producaoController@crete')->name('validacor');

Route::post('/admin/producaos/finaliza', [App\Http\Controllers\producaoController::class , 'finaliza'])->name('producaos.finaliza');


Route::post('/admin/producaos/validacor', [App\Http\Controllers\producaoController::class , 'validaCor'])->name('producaos.validacor');

Route::post('/admin/estoques/getproduct', [App\Http\Controllers\estoqueController::class , 'getproduct'])->name('estoque.getproduct');

Route::get('/admin/producaos/teste', [App\Http\Controllers\producaoController::class , 'teste'])->name('producaos.teste');

Route::get('/admin/ordems/maquina', [App\Http\Controllers\ordemController::class , 'maquina'])->name('ordems.maquina');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/opencart', [App\Http\Controllers\OpenCartAdminController::class, 'index'])->name('opencart.index');
    Route::post('/opencart/get-order', [App\Http\Controllers\OpenCartAdminController::class, 'getOrder'])->name('opencart.get_order');
    Route::get('/opencart/update-status', [App\Http\Controllers\OpenCartAdminController::class, 'updateStatusForm'])->name('opencart.update_status_form');
    Route::post('/opencart/update-order-status', [App\Http\Controllers\OpenCartAdminController::class, 'updateOrderStatus'])->name('opencart.update_order_status');

    Route::get('/relatorios/producao', [App\Http\Controllers\RelatorioController::class, 'producao'])->name('relatorios.producao');
});
