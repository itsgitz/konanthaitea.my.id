<?php

use Illuminate\Support\Facades\Route;

//
//Client area routes
//
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('client_home');

Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])
    ->name('client_about');

//Client user management routes
Route::get('/admin/clients', [\App\Http\Controllers\ClientsController::class, 'index'])
    ->name('admin_clients_get');

Route::get('/admin/clients/add', [\App\Http\Controllers\ClientsController::class, 'create'])
    ->name('admin_clients_add_get');

Route::post('/admin/clients/add', [\App\Http\Controllers\ClientsController::class, 'store'])
    ->name('admin_clients_add_post');

Route::get('/admin/clients/edit/{id}', [\App\Http\Controllers\ClientsController::class, 'edit'])
    ->name('admin_clients_edit_get');

Route::put('/admin/clients/edit/{id}', [\App\Http\Controllers\ClientsController::class, 'update'])
    ->name('admin_clients_edit_put');

Route::get('/admin/clients/delete/{id}', [\App\Http\Controllers\ClientsController::class, 'delete'])
    ->name('admin_clients_delete_get');
