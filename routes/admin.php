<?php

use Illuminate\Support\Facades\Route;

//
//Admin routes
//
Route::get('/admin', [\App\Http\Controllers\AdminsController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin_home');

//Admin user management routes
Route::get('/admin/accounts', [\App\Http\Controllers\AdminsController::class, 'account'])
    ->middleware('auth.admin')
    ->name('admin_accounts_get');

Route::get('/admin/accounts/add', [\App\Http\Controllers\AdminsController::class, 'create'])
    ->middleware('auth.admin')
    ->name('admin_accounts_add_get');

Route::post('/admin/accounts/add', [\App\Http\Controllers\AdminsController::class, 'store'])
    ->middleware('auth.admin')
    ->name('admin_accounts_add_post');

Route::get('/admin/accounts/edit/{id}', [\App\Http\Controllers\AdminsController::class, 'edit'])
    ->middleware('auth.admin')
    ->name('admin_accounts_edit_get');

Route::put('/admin/accounts/edit/{id}', [\App\Http\Controllers\AdminsController::class, 'update'])
    ->middleware('auth.admin')
    ->name('admin_accounts_edit_put');

Route::get('/admin/accounts/delete/{id}', [\App\Http\Controllers\AdminsController::class, 'delete'])
    ->middleware('auth.admin')
    ->name('admin_accounts_delete_get');
