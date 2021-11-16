<?php

use Illuminate\Support\Facades\Route;

//
//Login routes
//
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])
    ->middleware('guest')
    ->name('client_login_get');

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'auth'])
    ->middleware('guest')
    ->name('client_login_post');

Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('client_logout_post');

//
//Register routes
//
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'index'])
    ->middleware('guest')
    ->name('client_register_get');

Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('client_register_post');

