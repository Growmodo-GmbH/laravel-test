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
        User::create([
            'username' => 'Admin123',
            'email' => 'admin@example.com',
            'phone_number' => '0912-123-1234',
            'user_type' => 'Admin',
            'password' => Hash::make('password'),
        ]);
    }
}
