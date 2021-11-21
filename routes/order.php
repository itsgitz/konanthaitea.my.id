<?php

use Illuminate\Support\Facades\Route;

//
//Order routes
//

Route::get('/minuman/orders', [\App\Http\Controllers\OrdersController::class, 'clientIndex'])
    ->name('client_orders_get')
    ->middleware('auth');

Route::get('/minuman/orders/{id}', [\App\Http\Controllers\OrdersController::class, 'clientShow'])
    ->name('client_order_show')
    ->middleware('auth');

Route::post('/minuman/orders', [\App\Http\Controllers\OrdersController::class, 'clientProcess'])
    ->name('client_orders_post')
    ->middleware('auth');
