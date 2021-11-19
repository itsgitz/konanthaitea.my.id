<?php

use Illuminate\Support\Facades\Route;

//
//Cart routes
//
Route::get('/minuman/cart', [\App\Http\Controllers\CartController::class, 'index'])
    ->name('client_cart_get');

Route::post('/minuman/cart', [\App\Http\Controllers\CartController::class, 'store'])
    ->name('client_cart_post');

Route::get('/minuman/cart/delete/{cartId}', [\App\Http\Controllers\CartController::class, 'delete'])
    ->name('client_cart_delete')
    ->middleware('auth');

Route::get('/minuman/cart/edit/{cartId}', [\App\Http\Controllers\CartController::class, 'edit'])
    ->name('client_cart_edit')
    ->middleware('auth');

Route::put('/minuman/cart/edit/{cartId}', [\App\Http\Controllers\CartController::class, 'update'])
    ->name('client_cart_update')
    ->middleware('auth');
