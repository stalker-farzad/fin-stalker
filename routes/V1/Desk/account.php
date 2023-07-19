<?php

use App\Http\Controllers\V1\Desk\AccountController;
use Illuminate\Support\Facades\Route;

Route::prefix('/accounts')->controller(AccountController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{uuid}', 'show');
    Route::post('/', 'store');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'destroy');
});
