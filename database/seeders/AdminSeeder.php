<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create([
            'name'  => 'Admin'
        ]);

        User::create([
            'name'          => 'Admin admin',
            'username'      => 'admin',
            'phone_number'  => '111111111',
            'email'         => 'admin@mail.com',
            'password'      => \Hash::make('admin@1231'),
            'role_id'       => 1
        ]);

        Role::create([
            'name'  => 'User' 
        ]);
    }
}
