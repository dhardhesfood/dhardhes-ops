<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{

    protected $fillable = [

        'employee_id',
        'date',

        'check_in',
        'check_out',

        'work_minutes',

        'overtime_minutes',
        'late_minutes',

        'overtime_decimal',
        'late_decimal',

        'daily_salary',

        'extra_job_salary',
        'meal_allowance',
        'daily_total'

    ];

}