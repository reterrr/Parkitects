<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('login', 'login')->name('auth.login');
        Route::post('register', 'register')->name('auth.register');
        //Route::get('aaa', function () { return Route::getCurrentRoute()->gatherMiddleware(); });

    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'logout')->name('auth.logout');
    });
});


Route::controller(GoogleController::class)->prefix('auth/google')->group(function () {
    Route::post('login', 'login');
});
