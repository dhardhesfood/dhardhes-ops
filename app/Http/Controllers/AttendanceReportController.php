<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeCashLoan;

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
                'a.extra_job_salary',
                'a.meal_allowance',
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
                'a.extra_job_salary',
                'a.meal_allowance',
                'a.daily_total',
                'a.salary_paid',
                'a.loan_deduction',
                'a.bonus_amount'
            )
            ->where('a.employee_id',$employeeId)
            ->whereRaw("DATE_FORMAT(a.date,'%Y-%m') = ?",[$month])
            ->orderBy('a.date')
            ->get();

        $employee = $rows->first()->name ?? '';

        $totalWorkDays = $rows->whereNotNull('check_in')->count();

        $totalOvertime = $rows->sum('overtime_minutes');

        $totalLate = $rows->sum('late_minutes');

        $presentRows = $rows->whereNotNull('check_in');

        $totalSalary = $presentRows->sum('daily_total');

        $totalExtraJob = $presentRows->sum('extra_job_salary');

        $totalMealAllowance = $presentRows->sum('meal_allowance');

        $salaryPaid = $rows->max('salary_paid');

        $bonusAmount = $rows->max('bonus_amount');

       if($salaryPaid){

          // gaji sudah dibayar → gunakan snapshot
        $loanDeduction = $rows->max('loan_deduction');

      }else{

         // gaji belum dibayar → baca kasbon aktif
         $loan = EmployeeCashLoan::where('employee_id',$employeeId)
                 ->where('status','active')
                 ->first();

         $loanDeduction = 0;

      if($loan){
        $loanDeduction = min($loan->remaining_amount,$totalSalary);
     }

  }

        $salaryReceived = $totalSalary - $loanDeduction + $bonusAmount;

        return view('attendance_report',[
               'rows'=>$rows,
               'employee'=>$employee,
               'month'=>$month,
               'totalWorkDays'=>$totalWorkDays,
               'totalOvertime'=>$totalOvertime,
               'totalLate'=>$totalLate,
               'totalSalary'=>$totalSalary,
               'totalExtraJob'=>$totalExtraJob,
               'totalMealAllowance'=>$totalMealAllowance,
               'loanDeduction'=>$loanDeduction,
               'salaryReceived'=>$salaryReceived,
               'salaryPaid'=>$salaryPaid,
               'bonusAmount'=>$bonusAmount
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

    public function paySalary(Request $request)
{

    $employeeId = $request->employee_id;
    $month = $request->month;

    $rows = DB::table('attendance_logs')
        ->where('employee_id',$employeeId)
        ->whereRaw("DATE_FORMAT(date,'%Y-%m') = ?",[$month])
        ->get();

    $presentRows = $rows->whereNotNull('check_in');

    $totalSalary = $presentRows->sum('daily_total');

    $loan = EmployeeCashLoan::where('employee_id',$employeeId)
        ->where('status','active')
        ->first();

    $deduction = 0;    

    if($loan){

        $deduction = min($loan->remaining_amount,$totalSalary);

        $loan->paid_amount += $deduction;
        $loan->remaining_amount -= $deduction;

        if($loan->remaining_amount <= 0){
            $loan->remaining_amount = 0;
            $loan->status = 'paid';
        }

        $loan->save();
    }

    DB::table('attendance_logs')
        ->where('employee_id',$employeeId)
        ->whereRaw("DATE_FORMAT(date,'%Y-%m') = ?",[$month])
        ->update([
        'salary_paid' => 1,
        'loan_deduction' => $deduction,
        'salary_paid_at' => now()
    ]);

    return back()->with('success','Gaji berhasil dibayar. Kasbon telah diperbarui.');
}

public function setBonus(Request $request)
{

    $employeeId = $request->employee_id;
    $month = $request->month;
    $bonus = $request->bonus ?? 0;

    DB::table('attendance_logs')
        ->where('employee_id',$employeeId)
        ->whereRaw("DATE_FORMAT(date,'%Y-%m') = ?",[$month])
        ->update([
            'bonus_amount' => $bonus
        ]);

    return back()->with('success','Bonus berhasil disimpan');

}

}