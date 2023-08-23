<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::whereName('Admin')->first();

        $user = User::where('email', '=', 'admin@email.com')->first();
        if ($user === null) {
            $user = User::updateOrCreate([
                'name'                          => 'Admin',
                'email'                         => 'admin@email.com',
                'password'                      => Hash::make('admin'),
                'phone_number'                  => '12345678',
            ]);
            $user->attachRole($adminRole);
        }
    }
}