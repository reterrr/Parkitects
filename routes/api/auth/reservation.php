<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::controller(ReservationController::class)->prefix('reservations')->group(function () {
    Route::get('/', 'list');
    Route::prefix('/{reservation}')->group(function () {
        Route::get('/', 'find');
        Route::put('/', 'update');
        Route::delete('/', 'cancel');
    });
});

Route::post('parkings/{parking}/reservation', [ReservationController::class, 'create']);
