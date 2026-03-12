<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceLog;
use App\Models\Employee;
use App\Services\AttendanceCalculator;

class AttendanceController extends Controller
{

    public function store(Request $request)
    {

        $employee = Employee::findOrFail($request->employee_id);

        $result = AttendanceCalculator::calculate(
            $request->check_in,
            $request->check_out,
            $employee->daily_salary
        );

        AttendanceLog::create([

            'employee_id' => $employee->id,

            'date' => $request->date,

            'check_in' => $request->check_in,
            'check_out' => $request->check_out,

            'work_minutes' => $result['work_minutes'],

            'overtime_minutes' => $result['overtime_minutes'],
            'late_minutes' => $result['late_minutes'],

            'overtime_decimal' => $result['overtime_decimal'],
            'late_decimal' => $result['late_decimal'],

            'daily_salary' => $employee->daily_salary,

            'daily_total' => $result['daily_total']

        ]);

        return response()->json([
            'message' => 'Absensi berhasil disimpan'
        ]);

    }

}