<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use HasApiTokens;

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the provided value is an email or username
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Modify the request data with the correct field name
        $request->merge([$fieldType => $request->username]);

        $credentials = $request->only($fieldType, 'password');
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json(['status' => 200, 'message' => "Logged in successfully!", 'user' => $user, 'token' => $token], 200);
        }
        return response()->json(['status' => 401, 'message' => "Failed to log in!"], 401);
    }
}
