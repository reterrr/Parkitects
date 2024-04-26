<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('users/test', function (Request $request) { return $request->user()->mainPriority(); });

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/', 'all');
    Route::get('/{user}', 'find');
    Route::put('/{user}/update', 'update');
    Route::delete('/{user}', 'delete');
});
