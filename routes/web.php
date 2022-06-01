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

Route::post('/admin/producaos/validacor', [App\Http\Controllers\producaoController::class , 'validaCor'])->name('producaos.validacor');

Route::post('/admin/estoques/getproduct', [App\Http\Controllers\estoqueController::class , 'getproduct'])->name('estoque.getproduct');

Route::get('/admin/producaos/teste', [App\Http\Controllers\producaoController::class , 'teste'])->name('producaos.teste');
