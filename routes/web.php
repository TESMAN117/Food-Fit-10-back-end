<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use App\Http\Livewire\DetallePedidos;


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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth:sanctum', 'verified'], function () {
    //

    Route::get('/inicio', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/categorias', function () {
        return view('categorias.categorias');
    })->name('categorias');

    Route::get('/personas', function () {
        return view('personas.personas');
    })->name('personas');

    Route::get('/platillos', function () {
        return view('platillos.platillos');
    })->name('platillos');

    Route::get('/pedidos', function () {
        return view('pedidos.pedidos');
    })->name('pedidos');

    Route::get('/pedidos-detalle/{id}', function ($id) {
        return view('detalle_pedidos.detalle-pedidos', [
            'datos' => $id,
        ]);
    })->name('pedidos-detalle');

});
