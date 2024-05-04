<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::controller(ReservationController::class)->prefix('reservations')->group(function () {
    Route::get('/', 'list');
    Route::get('/{reservation}', 'find');
    Route::post('/', 'create');
});
