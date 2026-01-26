<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::insert([
            
            'name' => 'Athumani Mfaume',
            'email' => 'athumanimfaume1995@gmail.com',
            'password' => hash::make(123456789), 
        
        ]);
    }
}
