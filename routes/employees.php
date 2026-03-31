<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EmployeeController;

/*
================================
HALAMAN MASTER KARYAWAN
================================
*/

Route::get('/employees', function () {

    $employees = DB::table('employees')
        ->orderBy('name')
        ->get();

    return view('employees',[
        'employees'=>$employees
    ]);

});


/*
================================
SIMPAN KARYAWAN BARU
================================
*/

Route::post('/employees', function () {

    DB::table('employees')->insert([
        'name' => request('name'),
        'daily_salary' => request('daily_salary'),
        'status' => 'active',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect('/employees');

});

Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);

Route::post('/employees/{id}/toggle',[EmployeeController::class,'toggleStatus']);