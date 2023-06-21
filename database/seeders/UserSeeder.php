<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Provider\PhoneNumber;
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
        $adminRole = Role::where('name', 'admin')->first();

        $user = User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'password' => Hash::make($adminPassword),
            'phone'=>PhoneNumber::numerify('##########'),
            'email_verified_at' => now(),
            'role_id'=>$adminRole->id
        ]);
    }
    private function seedDummyUsers(): void
    {
        User::factory()->count(50)->create();
    }
}
