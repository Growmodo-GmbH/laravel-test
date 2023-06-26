<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

use Laravel\Sanctum\HasApiTokens;

class LoginController extends Controller
{
    use HasApiTokens;

    public function authenticate(Request $request)
    {
        // Get username and password

        $credentials = $request->only('username', 'password');

        // Manually authenticate user
        if (Auth::attempt($credentials)) {

            // Authenticated/logged in user
            $user = auth()->user();

            // Create token for authenticated/logged in user
            $token = $user->createToken('token-name');

            // Response status and message
            return response()->json(['status' => 200, 'message' => "Logged in successfully!", 'user' => $user, 'token' => $token->plainTextToken]);
        }

        // Response status and message
        return response()->json(['status' => 401, 'message' => "Failed to log in!"]);
    }
}
