<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'department_id',
        'position',
        'email',
        'phone',
        'dob',
        'salary',

    ];

    public function departments(){
        
        return $this->belongsTo(Department::class,'department_id');

    }

    public function leaves(){
        
        return $this->hasMany(Leave::class,'employee_id');

    }

    public function complains(){
        
        return $this->hasMany(Complain::class,'employee_id');

    }
}
