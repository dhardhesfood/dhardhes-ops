<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeCashLoan;

class CashLoanController extends Controller
{
    public function index()
    {
        $employees = Employee::where('status', 'active')->get();

        $loans = EmployeeCashLoan::with('employee')
            ->orderBy('loan_date', 'desc')
            ->get();

        return view('cash_loans', compact('employees', 'loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'loan_date' => 'required|date',
            'amount' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);

        EmployeeCashLoan::create([
            'employee_id' => $request->employee_id,
            'loan_date' => $request->loan_date,
            'amount' => $request->amount,
            'paid_amount' => 0,
            'remaining_amount' => $request->amount,
            'note' => $request->note,
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'Kasbon berhasil ditambahkan');
    }

    public function pay(Request $request, $id)
{

    $loan = EmployeeCashLoan::findOrFail($id);

    $amount = $request->amount;

    $loan->paid_amount += $amount;

    $loan->remaining_amount -= $amount;

    if($loan->remaining_amount <= 0){
        $loan->remaining_amount = 0;
        $loan->status = 'paid';
    }

    $loan->save();

    return redirect()->back();
}

}