<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Employee;
use App\Models\AttendanceLog;
use App\Services\AttendanceCalculator;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttendanceImportController extends Controller
{

    public function form()
{

    $employees = \App\Models\Employee::orderBy('name')->get();

    return view('attendance_upload',[
        'employees'=>$employees
    ]);

}

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|file'
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        $rows = Excel::toArray([], $request->file('file'));

        $sheet = $rows[0];

        foreach ($sheet as $row) {

    if (!isset($row[2])) {
        continue;
    }

    $dateText = trim($row[2]);

    if (!preg_match('/^\d{2}/', $dateText)) {
        continue;
    }

    $day = substr($dateText, 0, 2);
    $date = date('Y-m-' . $day);

    $checkIn = null;
    $checkOut = null;

    if (isset($row[3]) && is_numeric($row[3])) {
        $checkIn = gmdate("H:i", $row[3] * 86400);
    }

    if (isset($row[5]) && is_numeric($row[5])) {
        $checkOut = gmdate("H:i", $row[5] * 86400);
    }

    if ($checkIn && $checkOut) {

        $result = AttendanceCalculator::calculate(
            $checkIn,
            $checkOut,
            $employee->daily_salary
        );

    } else {

        $result = [
            'work_minutes' => 0,
            'overtime_minutes' => 0,
            'late_minutes' => 0,
            'overtime_decimal' => 0,
            'late_decimal' => 0,
            'daily_total' => 0
        ];

    }

    AttendanceLog::create([

        'employee_id' => $employee->id,
        'date' => $date,

        'check_in' => $checkIn,
        'check_out' => $checkOut,

        'work_minutes' => $result['work_minutes'],
        'overtime_minutes' => $result['overtime_minutes'],
        'late_minutes' => $result['late_minutes'],

        'overtime_decimal' => $result['overtime_decimal'],
        'late_decimal' => $result['late_decimal'],

        'daily_salary' => $employee->daily_salary,
        'daily_total' => $result['daily_total']
    ]);
   }

        foreach ($sheet as $row) {

    // proses import

    }

      $month = date('Y-m');

      return redirect('/attendance/report-view/'.$employee->id.'/'.$month);

    }

}