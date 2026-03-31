<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseBackupController;

Route::get('/database-backup',[DatabaseBackupController::class,'index']);
Route::post('/database-backup/run',[DatabaseBackupController::class,'run']);
Route::get('/database-backup/download/{file}',
    [DatabaseBackupController::class,'download']
);