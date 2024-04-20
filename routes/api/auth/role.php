<?php


use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::controller(RoleController::class)->prefix('roles')->group(function () {
    Route::get('/', 'all');
    Route::get('/{role}', 'find');
    Route::post('/create', 'create');
    Route::delete('/{role}', 'delete');
    Route::put('/{role}', 'update');
});
