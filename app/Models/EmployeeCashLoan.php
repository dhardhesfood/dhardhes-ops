<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class EmployeeCashLoan extends Model
{
    use HasFactory;

    protected $table = 'employee_cash_loans';

    protected $fillable = [
        'employee_id',
        'loan_date',
        'amount',
        'paid_amount',
        'remaining_amount',
        'note',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}