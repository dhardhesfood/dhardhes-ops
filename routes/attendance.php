<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceImportController;
use App\Http\Controllers\AttendanceReportController;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

Route::prefix('attendance')->group(function () {

    Route::post('/', [AttendanceController::class, 'store']);

    Route::post('/import', [AttendanceImportController::class, 'import']);

    Route::post('/set-bonus',[AttendanceReportController::class,'setBonus']);

    Route::get('/report/{employee}/{month}', [AttendanceReportController::class, 'report']);

    Route::get('/report-view/{employee}/{month}', [AttendanceReportController::class, 'reportView']);

    Route::get('/upload', function () {

        $employees = Employee::where('status','active')->get();

        $uploads = DB::table('attendance_logs as a')
    ->join('employees as e','e.id','=','a.employee_id')
    ->select(
        'e.id as employee_id',
        'e.name',
        DB::raw("DATE_FORMAT(a.date,'%Y-%m') as month"),
        DB::raw("MAX(a.salary_paid) as salary_paid"),
        DB::raw("MAX(a.salary_paid_at) as salary_paid_at")
    )
    ->groupBy('e.id','e.name','month')
    ->orderBy('month','desc')
    ->get();

        return view('attendance_upload', [
            'employees' => $employees,
            'uploads' => $uploads
        ]);

    });

});