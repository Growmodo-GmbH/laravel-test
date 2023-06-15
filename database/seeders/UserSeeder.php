<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $this->seedAdmin();
        $this->seedDummyUsers();
    }

    private function seedAdmin(): void
    {
        $adminName = env('ADMIN_NAME');
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        $user = User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'password' => Hash::make($adminPassword),
        ]);
    }
    private function seedDummyUsers(): void
    {
        User::factory()->count(50)->create();
    }
}
