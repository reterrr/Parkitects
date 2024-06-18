<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::controller(RoleController::class)->prefix('roles')->group(function () {
    Route::get('/', 'list');
    Route::prefix('/{role}')->group(function () {
        Route::get('/', 'find');
    });
});

Route::post('users/{user}/roles', [RoleController::class, 'attachRoles']);
Route::delete('users/{user}/roles', [RoleController::class, 'detachRoles']);
