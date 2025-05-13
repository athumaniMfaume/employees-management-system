<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{

    use HasFactory;

    protected $fillable = [
        'employee_id',
        'basic_salary',
        'allowance',
        'deductions',
        'net_salary',
        'pay_date'
    ];

    public function employee()
{
    return $this->belongsTo(Employee::class, 'employee_id');
}
}
