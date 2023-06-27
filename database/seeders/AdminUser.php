<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Foundation\Auth\User;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default admin user
        User::create([
            'username'=>'admin',
            'email'=>'admin@growmodo.com',
            'phone_number'=>"09123456789",
            'password'=> bcrypt('admin')]);
    }
}
