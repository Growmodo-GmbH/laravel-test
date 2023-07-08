<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    /**
     * Register a new user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed',
            'is_admin' => 'boolean',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->plainTextToken;

        return response()->json(['user' => $user, 'access_token' => $accessToken], 201);
    }

    /**
     * Log in an existing user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (!Auth::attempt([$field => $request->input('login'), 'password' => $request->input('password')]) || !Auth::user()->is_active) {
            return response()->json(['message' => 'Invalid credentials or account deactivated!'], 401);
        }

        $accessToken = Auth::user()->createToken('authToken')->plainTextToken;
        $role = Auth::user()->is_admin ? 'admin' : 'guest';

        return response()->json(['user' => Auth::user(), 'access_token' => $accessToken, 'role' => $role], 200);
    }

    /**
     * Log out the authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
