<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
            'name' => 'Admin',
            'email' => 'athumanimfaume1995@gmail.com',
            'password' => hash::make(123456789), 
        ],

                    [
            'name' => 'Administrator',
            'email' => 'athumanimfaume1995@gmail.com',
            'password' => hash::make(123456), 
        ],

        ]);
    }
}
