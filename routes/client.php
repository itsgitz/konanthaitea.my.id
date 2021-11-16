<?php

use Illuminate\Support\Facades\Route;

//
//Client area route
//
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('client_home');

