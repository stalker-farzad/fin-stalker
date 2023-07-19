<?php

use App\Http\Controllers\V1\my\Team\TraderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/traders')->controller(TraderController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{uuid}', 'show');
    Route::post('/', 'store');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'destroy');
});
