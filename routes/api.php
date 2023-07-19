<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    include __DIR__ ."/V1/api.php";
});
