<?php


use App\Http\Controllers\ParkingController;
use Illuminate\Support\Facades\Route;

Route::controller(ParkingController::class)->prefix('parkings')->group(function () {
    Route::get('', 'list');
    Route::prefix('{parking}')->group(function () {
        Route::get('', 'find');
        Route::get('free-places', 'checkFreePlaces');
    });
});
