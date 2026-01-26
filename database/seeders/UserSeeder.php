<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // updateOrCreate checks the first array (email)
        // If it exists, it updates the record. If not, it creates it.
        User::updateOrCreate(
            ['email' => 'athumanimfaume1995@gmail.com'], 
            [
                'name' => 'Admin',
                'password' => Hash::make('123456789'), // Ensure password is a string
            ]
        );
    }
}
