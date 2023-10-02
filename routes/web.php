<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedoreController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/clientes', ClienteController::class) -> middleware('auth');
Route::resource('/categorias', CategoriaController::class) -> middleware('auth');
Route::resource('/proveedores', ProveedoreController::class) -> middleware('auth');
Route::resource('/productos', ProductoController::class) -> middleware('auth');
Route::resource('/venta', VentaController::class) -> middleware('auth');