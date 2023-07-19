<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return redirect('https://dalan.capital/docs/api/', 301);
});
