<?php

use Illuminate\Support\Facades\Route;

//
//Cart routes
//
Route::get('/minuman/cart', [\App\Http\Controllers\CartController::class, 'index'])
    ->name('client_cart_get');

Route::post('/minuman/cart', [\App\Http\Controllers\CartController::class, 'store'])
    ->name('client_cart_post');

Route::post('/minuman/checkout/{cartId}', [\App\Http\Controllers\CartController::class, 'checkout'])
    ->name('client_checkout_post');

