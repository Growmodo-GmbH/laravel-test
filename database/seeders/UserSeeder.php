<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'phone' => '123456789',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'subscription' => 'subscribed'
        ]);
    }
}
