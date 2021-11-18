<?php

use Illuminate\Support\Facades\Route;

//
//Cart routes
//
Route::get('/minuman/cart', [\App\Http\Controllers\CartController::class, 'index'])
    ->name('client_cart_get');

Route::post('/minuman/cart', [\App\Http\Controllers\CartController::class, 'store'])
    ->name('client_cart_post');

Route::get('/minuman/cart/delete', [\App\Http\Controllers\CartController::class, 'delete'])
    ->name('client_cart_delete');
