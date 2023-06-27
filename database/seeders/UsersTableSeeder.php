<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'phone_number' => '1234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Guest User
        User::create([
            'name' => 'Guest User',
            'username' => 'guest',
            'email' => 'guest@example.com',
            'phone_number' => '9876543210',
            'password' => Hash::make('password'),
            'role' => 'guest',
        ]);
    }
}
