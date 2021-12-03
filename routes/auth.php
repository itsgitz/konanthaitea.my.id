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

Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])
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

//
//Login routes for admin
//
Route::get('/admin/login', [\App\Http\Controllers\AdminsController::class, 'login'])
    ->middleware('guest.admin')
    ->name('admin_login_get');

Route::post('/admin/login', [\App\Http\Controllers\AdminsController::class, 'auth'])
    ->middleware('guest.admin')
    ->name('admin_login_post');

Route::get('/admin/logout', [\App\Http\Controllers\AdminsController::class, 'logout'])
    ->middleware('auth.admin')
    ->name('admin_logout_get');
