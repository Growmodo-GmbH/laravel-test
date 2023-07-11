<?php

namespace App\Services;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;

class UserService 
{
	public function register($data): array
	{
		$data['password'] = bcrypt($data['password']);

		if (User::all()->isEmpty()) {
			$data['is_admin'] = 1;
		}
		
		$user = new UserResource(User::create($data));

		$token = $user->createToken('main')->plainTextToken;

		return [
			'user' => $user,
			'token' => $token,
		];
	}

	public function login($data): array
	{
		if (!auth()->attempt($data)) {
			return response([
				'error' => 'The provided credentials are not correct.'
			], 422);
		}

		$user = auth()->user();

		$token = $user->createToken('main')->plainTextToken;

		return [
			'user' => $user,
			'token' => $token,
		];
	}

	public function logout(): User
	{
		$user = auth()->user();

		$user->currentAccessToken()->delete();

		return $user;
	}

	public function store(array $data): User
	{
		$data['password'] = bcrypt(request('username') . substr(request('phone_number'), -4));

		$user = User::create($data);

		return $user;
	}

	public function update(array $data, int $id): User
	{
		$user = User::find($id);

		$user->update($data);

		return $user;
	}

	public function destroy(int $id): void
	{
		$user = User::find($id);

		$user->delete();
	}
}
