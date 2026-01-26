<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Human Resources'],
            ['name' => 'Finance and Accounting'],
            ['name' => 'Information Technology (IT)'],
            ['name' => 'Sales and Marketing'],
            ['name' => 'Procurement and Logistics'],
            ['name' => 'Operations'],
            ['name' => 'Legal and Compliance'],
            ['name' => 'Customer Support'],
            ['name' => 'Administration']
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(
                ['name' => $department['name']],
                []
            );
        }
    }
}

