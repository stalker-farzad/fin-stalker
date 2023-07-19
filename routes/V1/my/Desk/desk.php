<?php

use App\Http\Controllers\V1\my\Desk\DeskController;
use Illuminate\Support\Facades\Route;

Route::controller(DeskController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{uuid}', 'show');
    Route::post('/', 'store');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'destroy');
});
