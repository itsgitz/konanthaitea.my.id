<?php

use Illuminate\Support\Facades\Route;

//
//Order routes
//
/* Route::get('/minuman/orders', [\App\Http\Controllers\OrdersController::class, 'clientIndex']) */
/*     ->middleware('auth') */
/*     ->name('client_orders_get'); */

/* Route::get('/minuman/orders/{id}', [\App\Http\Controllers\OrdersController::class, 'clientShow']) */
/*     ->middleware('auth') */
/*     ->name('client_order_get'); */

Route::post('/minuman/orders', [\App\Http\Controllers\OrdersController::class, 'clientProcess'])
    ->name('client_order_post')
    ->middleware('auth');
