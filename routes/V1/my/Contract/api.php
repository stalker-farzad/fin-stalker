<?php

use App\Http\Controllers\V1\my\Contract\ContractController;
use Illuminate\Support\Facades\Route;

Route::prefix('/contracts')->controller(ContractController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{uuid}', 'show');
    Route::post('/', 'store');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'destroy');
});
