<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'username' => 'Test User 2',
            'email' => 'test2@example.com',
            'is_admin' => 0,
        ]);
    }
}
