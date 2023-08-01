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
        $validationRules = [
            'password' => 'required|string',
        ];

        // Determine if the username or email field is provided
        $usernameOrEmail = $request->input('username_email');
        $field = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Add the username/email field dynamically to the validation rules
        $validationRules[$field] = 'required|string';

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Attempt authentication using the provided username/email and password
        if (Auth::once($request->only($field, 'password'))) {
            $user = auth()->user();
            $token = $user->createToken('token-name');

            return response()->json(['status' => 200, 'message' => 'Logged in successfully!', 'user' => $user, 'token' => $token->plainTextToken], 200);
        }

        return response()->json(['status' => 401, 'message' => 'Invalid credentials'], 401);
    }
}
