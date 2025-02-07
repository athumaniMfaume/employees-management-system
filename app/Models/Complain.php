<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $fillable = ['employee_id', 'content', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
