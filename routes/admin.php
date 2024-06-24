<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticuloController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\SubcategoriaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\OrdenController;
use App\Http\Controllers\Admin\SucursalController;
use App\Http\Controllers\Admin\MarquesinaController;

//===================================//
// Rutas del panel de administración //
//===================================//

Route::controller(AdminController::class)->group(function () {
    Route::get('',              'index')->name('admin.login');
    Route::post('',             'login');
    Route::get('logout',        'logout');
    Route::get('facturas',      'facturas');
    Route::get('visitas',       'visitas');

    // Rutas que requieren autenticación
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', 'dashboard')->name('admin.dashboard');
        
        Route::match(['get', 'post'], 'comercio',  'comercio');
        Route::match(['get', 'post'], 'mantenimiento', 'mantenimiento')->name('admin.mantenimiento');

        Route::resource('articulos',        ArticuloController::class);
        Route::resource('banners',          BannerController::class);
        Route::resource('categorias',       CategoriaController::class);
        Route::resource('subcategorias',    SubcategoriaController::class);
        Route::resource('usuarios',         UsuarioController::class);
        Route::resource('ordenes',          OrdenController::class);
        Route::resource('sucursales',       SucursalController::class);
        Route::resource('marquesinas',      MarquesinaController::class);
    });
});