<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceReportController extends Controller
{

    public function monthly($employeeId, $month)
    {

        $data = DB::table('attendance_logs as a')
            ->join('employees as e', 'e.id', '=', 'a.employee_id')
            ->select(
                'e.name',
                'a.date',
                'a.check_in',
                'a.check_out',
                'a.work_minutes',
                'a.overtime_minutes',
                'a.late_minutes',
                'a.daily_total'
            )
            ->where('a.employee_id', $employeeId)
            ->whereRaw("DATE_FORMAT(a.date,'%Y-%m') = ?", [$month])
            ->orderBy('a.date')
            ->get();

        return response()->json($data);

    }

    public function monthlyView($employeeId,$month)
    {

        $rows = \DB::table('attendance_logs as a')
            ->join('employees as e','e.id','=','a.employee_id')
            ->select(
                'e.name',
                'a.date',
                'a.check_in',
                'a.check_out',
                'a.work_minutes',
                'a.overtime_minutes',
                'a.late_minutes',
                'a.daily_total'
            )
            ->where('a.employee_id',$employeeId)
            ->whereRaw("DATE_FORMAT(a.date,'%Y-%m') = ?",[$month])
            ->orderBy('a.date')
            ->get();

        $employee = $rows->first()->name ?? '';

        $totalWorkDays = $rows->whereNotNull('check_in')->count();

        $totalOvertime = $rows->sum('overtime_minutes');

        $totalLate = $rows->sum('late_minutes');

        $totalSalary = $rows->sum('daily_total');
        
        return view('attendance_report',[
            'rows'=>$rows,
            'employee'=>$employee,
            'month'=>$month,
            'totalWorkDays'=>$totalWorkDays,
            'totalOvertime'=>$totalOvertime,
            'totalLate'=>$totalLate,
            'totalSalary'=>$totalSalary
        ]);

    }


    /*
    ======================================
    METHOD TAMBAHAN UNTUK ROUTE YANG ADA
    ======================================
    Tidak mengubah logic existing
    hanya mengarahkan ke method yang sudah ada
    */

    public function report($employee,$month)
    {
        return $this->monthly($employee,$month);
    }

    public function reportView($employee,$month)
    {
        return $this->monthlyView($employee,$month);
    }

}