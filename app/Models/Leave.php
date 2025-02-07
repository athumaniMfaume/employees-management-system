<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = ['employee_id', 'type', 'reason', 'start_date', 'end_date', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
