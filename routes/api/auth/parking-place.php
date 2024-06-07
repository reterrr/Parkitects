<?php

use App\Http\Controllers\ParkingPlaceController;
use Illuminate\Support\Facades\Route;

Route::controller(ParkingPlaceController::class)->prefix('parking-places')->group(function () {
    Route::get('/', 'list');
    Route::prefix('/{parking-place}')->group(function () {
        Route::get('', 'find');
    });
});
