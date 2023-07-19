<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/teams')->group(function () {
    include __DIR__.'/trader.php';
    include __DIR__.'/team.php';
});
