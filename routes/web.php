<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

require __DIR__.'/attendance.php';
require __DIR__.'/employees.php';
require __DIR__.'/production.php';
require __DIR__.'/performance.php';