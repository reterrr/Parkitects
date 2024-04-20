<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/', 'all');
    Route::get('/{user}', 'find');
    Route::put('/{user}/update', 'update');
    Route::delete('/{user}', 'delete');
});
