<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::controller(PermissionController::class)->prefix('users/{user}/permissions')->group(function () {
    Route::post('', 'attachPermissions');
    Route::delete('', 'detachPermissions');
});

Route::controller(PermissionController::class)->prefix('permissions/')->group(function () {
    Route::get('', 'list');
    Route::prefix('{permission}')->group(function () {
        Route::get('', 'find');
    });
});



