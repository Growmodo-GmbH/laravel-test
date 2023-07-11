<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_login()
	{
		$user = User::factory()->create([
			'username' => 'Test User',
			'email' => 'test@example.com',
		]);

		$this->post(route('login'), [
			'email' => $user->email,
			'password' => 'password',
		])->assertSuccessful();

        $this->assertTrue(auth()->check());
	}

	public function test_user_can_register()
	{
		$user = User::factory()->raw([
			'password' => 'Pa$$w0rd!',
			'password_confirmation' => 'Pa$$w0rd!'
		]);

		$this->post(route('register'), $user)->assertSuccessful();

		$this->assertDatabaseCount('users', 1);

		$this->assertDatabaseHas('users', [
            'username' => $user['username'],
        ]);
	}
}
