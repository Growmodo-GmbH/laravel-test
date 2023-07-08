<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => Hash::make('adminpassword'),
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
