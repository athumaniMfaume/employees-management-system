<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first department or create one if none exists
        $department = Department::firstOrCreate(['name' => 'Information Technology (IT)']);

        // updateOrCreate( [unique search criteria], [data to update/create] )
        Employee::updateOrCreate(
            ['email' => 'athumanimfaume1995@gmail.com'], // Unique identifier
            [
                'name' => 'Athumani Mfaume',
                'password' => Hash::make('123456789'),
                'gender' => 'male',
                'position' => 'Software Engineer',
                'phone' => '+255754123456',
                'dob' => '1995-01-01',
                'salary' => 500000,
                'department_id' => $department->id,
                'image' => 'default.png',
            ]
        );
    }
}