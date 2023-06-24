<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request){
        // make sure all the input data are valid
        $data = Validator::make($request->all(), [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)
                                 ->orWhere('username', $request->username);
                }),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)
                                 ->orWhere('username', $request->username);
                }),
            ],
            'phone_number' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        // if($request['password'] !== $request['confirm_password']){
        //     return response()->json(['errors' => "Passwords don't match"], 422);
        // }

        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }

        $user = User::create([
            'username'     => $request->username,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'password'     => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Registration successful', 'user' => $user, 'token' => $token]);
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json(['error' => 'Incorrect Details'], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('auth')->plainTextToken;

        return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token]);
    }

    public function logout(){
        return Auth::logout();
    }
}
