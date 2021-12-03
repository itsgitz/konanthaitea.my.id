<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/menus', [\App\Http\Controllers\MenusController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin_menu_get');

Route::get('/admin/menus/{id}', [\App\Http\Controllers\MenusController::class, 'show'])
    ->where('id', '[0-9]+')
    ->middleware('auth.admin')
    ->name('admin_menu_show_get');

Route::get('/admin/menus/add', [\App\Http\Controllers\MenusController::class, 'create'])
    ->middleware('auth.admin')
    ->name('admin_menu_add_get');

Route::post('/admin/menus/add', [\App\Http\Controllers\MenusController::class, 'store'])
    ->middleware('auth.admin')
    ->name('admin_menu_add_post');

Route::get('/admin/menus/edit/{id}', [\App\Http\Controllers\MenusController::class, 'edit'])
    ->middleware('auth.admin')
    ->name('admin_menu_edit_get');

Route::put('/admin/menus/edit/{id}', [\App\Http\Controllers\MenusController::class, 'update'])
    ->middleware('auth.admin')
    ->name('admin_menu_edit_put');

Route::get('/admin/menus/delete/{id}', [\App\Http\Controllers\MenusController::class, 'delete'])
    ->middleware('auth.admin')
    ->name('admin_menu_delete_get');
