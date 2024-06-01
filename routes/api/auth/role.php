<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::controller(RoleController::class)->prefix('roles')->group(function () {
    Route::get('/', 'list');
    Route::prefix('/{role}')->group(function () {
        Route::delete('/', 'delete');
        Route::put('/', 'update');
        Route::get('/', 'find');
    });
});
