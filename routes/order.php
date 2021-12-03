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


Route::get('/admin/orders', [\App\Http\Controllers\OrdersController::class, 'adminIndex'])
    ->middleware('auth.admin')
    ->name('admin_orders_get');

Route::get('/admin/orders/{id}', [\App\Http\Controllers\OrdersController::class, 'adminShow'])
    ->middleware('auth.admin')
    ->name('admin_orders_show_get');

Route::put('/admin/orders/process/{id}', [\App\Http\Controllers\OrdersController::class, 'adminProcess'])
    ->middleware('auth.admin')
    ->name('admin_orders_process');

