<?php

use Illuminate\Support\Facades\Route;

Route::get('/{static}', function () {
    return view('welcome');
})->where('static', '.*');
