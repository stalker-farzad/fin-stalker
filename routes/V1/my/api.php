<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'my', 'middleware' => 'auth.werify'], function(){
    include __DIR__.'/Desk/api.php';
    include __DIR__.'/Team/api.php';
    include __DIR__.'/Contract/api.php';
});
