<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_users_can_be_viewed_only_by_admin()
	{
        $admin = User::factory()->create();

		$this->actingAs($admin)->get(route('users.index'))->assertSuccessful();
	}

	public function test_user_can_be_created_only_by_admin()
	{
        $admin = User::factory()->create();

		$user = User::factory()->raw();
		
		$this->actingAs($admin)->post(route('users.store'), $user)->assertSuccessful();

		$this->assertDatabaseCount('users', 2);
	}

	public function test_user_can_be_updated_only_by_admin()
	{
		$this->withoutExceptionHandling();
		$admin = User::factory()->create();

		$user = User::factory()->raw([
			'email' => 'test2@example.com'
		]);

		$this->actingAs($admin)->post(route('users.store'), $user)->assertSuccessful();
		
		$this->assertDatabaseCount('users', 2);
		$this->assertDatabaseHas('users', [
            'username' => $user['username'],
        ]);

		$user = User::firstWhere('email', 'test2@example.com');
		$user->email = 'test3@example.com';


		$this->actingAs($admin)->put(route('users.update', $user->id), $user->toArray())->assertSuccessful();

		$this->assertDatabaseCount('users', 2);
		$this->assertDatabaseHas('users', [
            'email' => 'test3@example.com',
        ]);
	}

	public function test_user_can_be_deleted_only_by_admin()
	{
		$admin = User::factory()->create();

		$user = User::factory()->create();

		$this->actingAs($admin)->delete(route('users.destroy', $user->id))->assertSuccessful();
	}
}
