<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/', 'list');
    Route::get('/me', 'findMe');
    Route::prefix('/{user}')->group(function () {
        Route::get('/', 'find');
        Route::put('/update', 'update');
        Route::delete('/', 'delete');
    });
});
