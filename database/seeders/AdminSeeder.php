<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('userAdmin#123'),
            'is_admin' => true,
        ]);
    }
}
