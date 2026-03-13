<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceReportController;

Route::view('/', 'dashboard');
Route::view('/dashboard', 'dashboard');

Route::delete('/attendance/{employee}/{month}',
    [AttendanceController::class,'destroy']
)->name('attendance.destroy');

Route::get('/employees',[EmployeeController::class,'index']);
Route::post('/employees',[EmployeeController::class,'store']);

Route::get('/employees/{id}/edit',[EmployeeController::class,'edit']);
Route::put('/employees/{id}',[EmployeeController::class,'update']);

Route::delete('/employees/{id}',[EmployeeController::class,'destroy']);

Route::post('/attendance/pay-salary',[AttendanceReportController::class,'paySalary']);

require __DIR__.'/attendance.php';
require __DIR__.'/employees.php';
require __DIR__.'/production.php';
require __DIR__.'/performance.php';
require __DIR__.'/cash_loans.php';