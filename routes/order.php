<?php

use Illuminate\Support\Facades\Route;

//
//Order routes
//

Route::get('/minuman/orders', [\App\Http\Controllers\OrdersController::class, 'clientIndex'])
    ->name('client_orders_get')
    ->middleware('auth');

Route::post('/minuman/orders', [\App\Http\Controllers\OrdersController::class, 'clientProcess'])
    ->name('client_orders_post')
    ->middleware('auth');
