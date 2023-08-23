<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        $fieldUserLogin = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (!$this->guard()->attempt([$fieldUserLogin => $request->input('email'), 'password' => $request->input('password')])) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }
        $this->guard()->attempt([$fieldUserLogin => $request->input('email'), 'password' => $request->input('password')]);
        $token = $this->guard()->user()->createToken('auth-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $this->guard()->logout();

        return response()->json([
            'status_code' => '200',
            'message'     => 'logged out successfully',
        ]);
    }

    public function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }
}
