<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Faker\Provider\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $guestRole = Role::where('name', 'guest')->first();
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone'=>PhoneNumber::numerify('##########'),
            'role_id'=>$guestRole->id,
            'email_verified_at' => now(),
            'password' => 'bypass', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
