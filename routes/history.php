<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/stocks/histories', [\App\Http\Controllers\RestockHistoriesController::class, 'index'])
    ->name('admin_stocks_histories_get');
