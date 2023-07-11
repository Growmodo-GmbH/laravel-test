<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\users\auth\UserLoginRequest;
use App\Http\Requests\users\auth\UserRegisterRequest;

class AuthController extends Controller
{
	public function register(UserRegisterRequest $request)
	{
		$data = (new UserService())->register($request->validated());

		return response([
			'user' => $data['user'],
			'token' => $data['token'],
		], 201);
	}

	public function login(UserLoginRequest $request)
	{
		$data = (new UserService())->login($request->validated());

		return response([
				'user' => $data['user'],
				'token' => $data['token'],
		], 201);
	}

	public function logout()
	{
		(new UserService())->logout();

		return [
			'message' => 'User has been logged out.',
		];
	}
}
