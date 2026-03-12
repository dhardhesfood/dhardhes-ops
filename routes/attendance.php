<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceImportController;
use App\Http\Controllers\AttendanceReportController;
use App\Models\Employee;

Route::prefix('attendance')->group(function () {

    Route::post('/', [AttendanceController::class, 'store']);

    Route::post('/import', [AttendanceImportController::class, 'import']);

    Route::get('/report/{employee}/{month}', [AttendanceReportController::class, 'report']);

    Route::get('/report-view/{employee}/{month}', [AttendanceReportController::class, 'reportView']);

    Route::get('/upload', function () {

    $employees = Employee::where('status','active')->get();

    return view('attendance_upload', compact('employees'));

});

});