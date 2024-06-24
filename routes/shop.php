<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CheckoutController;


//============================//
// Rutas sistema de ecommerce //
//============================//

Route::controller(ShopController::class)->group(function () {
    Route::get('',                  	'index');
    Route::get('item/{id}',         	'item');
    Route::get('banner/{banner}',       'banners');
    Route::get('login',             	'login')->name('user.login');
    Route::get('register',          	'register');
    Route::get('recovery',          	'recovery');
    Route::get('infopago/{id}',     	'infoPago');
    Route::get('logout',				'logout');

    // Rutas que requieren autenticación
    Route::middleware(['auth:web'])->group(function () {
        Route::get('favoritos',        	'favoritos');
        
        Route::get('payment',          	'payment');
        Route::get('success',          	'success');

        Route::get('account',          	'account')->name('user.account');
        Route::post('account',          'account');

        Route::get('compras',           'compras');
        Route::get('compras/estado',    'estadocompras');
    });
});

Route::controller(CheckoutController::class)->group(function () {
    Route::middleware(['auth:web'])->group(function () {
        Route::match(['get', 'post'], 'checkout', 'checkout');
    });
});

Route::controller(MailController::class)->group(function () {
    Route::get('/activate/{token}',     'VerifyEmail');
});

Route::controller(UsuarioController::class)->group(function () {
    Route::post('login',                'login')->name('login.user');
    Route::post('modal-login',          'modalLogin')->name('login.modal');
    Route::post('login/guest',          'loginGuest')->name('login.guest');
    Route::post('register',          	'register');
    Route::post('recovery',             'recovery');
});

// Procesador de pagos
Route::post('process_payment', [PaymentController::class, 'process_payment']);

// Shop requests
Route::controller(RequestController::class)->group(function () {
    Route::post('requests/infoItem',                        'infoItem');
    Route::post('requests/atributosItem',                   'atributosItem');
    Route::post('requests/getItemInfoAndAttributes/{id}',   'getItemInfoAndAttributes');
    
    Route::post('requests/updateCart',                      'updateCart');
    Route::post('requests/suscribe',                        'suscribe');

    Route::post('requests/rating',                          'rating');

    Route::post('requests/views/payment-methods/',          'paymentViews');

    // Rutas que requieren autenticación
    Route::middleware(['auth:web'])->group(function () {
        Route::post('requests/agregaFavorito',              'agregaFavorito');
        Route::post('requests/aplicaCupon',                 'aplicaCupon');
        Route::post('requests/eliminaFavorito',             'eliminaFavorito');
        Route::post('requests/costoEnvio',                  'costoEnvio');
    });
});