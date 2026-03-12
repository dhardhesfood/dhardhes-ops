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
            'status'=>'active'
        ]);

        return redirect('/employees');

    }

}