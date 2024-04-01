<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function() {
    Route::view('/', 'welcome')->name('home');
});


Route::controller(GoogleController::class)->prefix('auth/google')
    ->group(function () {
        Route::get('redirect', 'page');
        Route::get('callback', 'token');
    });
