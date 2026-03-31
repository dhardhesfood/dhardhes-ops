<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function index()
    {

        $employees = Employee::orderBy('id','desc')->get();

        return view('employees',[
            'employees'=>$employees
        ]);

    }

    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'daily_salary'=>'required'
        ]);

        Employee::create([
            'name'=>$request->name,
            'daily_salary'=>$request->daily_salary,
            'extra_job_salary' => $request->extra_job_salary ?? 0,
            'meal_allowance' => $request->meal_allowance ?? 0,
            'status'=>'active'
        ]);

        return redirect('/employees');

    }

    public function edit($id)
{
    $employee = Employee::findOrFail($id);

    return view('employees_edit',[
        'employee'=>$employee
    ]);
}

public function update(Request $request,$id)
{

    $request->validate([
        'name'=>'required',
        'daily_salary'=>'required'
    ]);

    $employee = Employee::findOrFail($id);

    $employee->update([
        'name'=>$request->name,
        'daily_salary'=>$request->daily_salary,
        'extra_job_salary'=>$request->extra_job_salary ?? 0,
        'meal_allowance'=>$request->meal_allowance ?? 0
    ]);

    return redirect('/employees');

}

public function destroy($id)
{

    $employee = Employee::findOrFail($id);

    $employee->update([
        'status'=>'inactive'
    ]);

    return redirect('/employees');

}

public function toggleStatus($id)
{
    $employee = Employee::findOrFail($id);

    if($employee->status == 'active'){
        $employee->status = 'inactive';
    }else{
        $employee->status = 'active';
    }

    $employee->save();

    return redirect('/employees');
}

}