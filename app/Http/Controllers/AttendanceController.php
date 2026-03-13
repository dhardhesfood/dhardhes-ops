<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceLog;
use App\Models\Employee;
use App\Services\AttendanceCalculator;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function store(Request $request)
    {

        $employee = Employee::findOrFail($request->employee_id);

        $result = AttendanceCalculator::calculate(
        $request->check_in,
        $request->check_out,
        $employee->daily_salary,
        $employee->extra_job_salary,
        $employee->meal_allowance
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

            'extra_job_salary' => $employee->extra_job_salary,
            'meal_allowance' => $employee->meal_allowance,

            'daily_total' => $result['daily_total']

        ]);

        return response()->json([
            'message' => 'Absensi berhasil disimpan'
        ]);

    }


    public function destroy($employeeId,$month)
    {

        DB::table('attendance_logs')
            ->where('employee_id',$employeeId)
            ->whereRaw("DATE_FORMAT(date,'%Y-%m') = ?",[$month])
            ->delete();

        return back()->with('success','Data absensi berhasil dihapus');

    }

}