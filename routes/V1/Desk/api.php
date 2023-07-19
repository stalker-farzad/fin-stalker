<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/desks')->group(function () {
    include __DIR__.'/account.php';
    include __DIR__.'/desk.php';
});
