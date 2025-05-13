<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use this instead of Model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasFactory, HasApiTokens;


    protected $fillable = [
        'name', 'gender', 'email', 'password', 'position', 'phone', 'dob', 'salary', 'department_id','image'
    ];



        protected $hidden = [
        'password', 'remember_token',
    ];

    public function salaries()
{
    return $this->hasOne(Salary::class,'employee_id');
}

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
