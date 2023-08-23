<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|min:3|max:255|unique:users,name',
            'email'     => 'required|email|unique:users,email',
            'phone_number'     => 'required|integer',
            'password'  => 'required|min:6|max:255|confirmed',
        ]);

        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'phone_number'     => $data['phone_number'],
            'password'  => Hash::make($data['password']),
        ]);

        if ($user) {
            $userRole = config('roles.models.role')::whereName('User')->first();
            $user->attachRole($userRole);
            $token = $user->createToken('access_token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'type'  => 'Bearer',
                'user'  => $user,
            ], 201);
        }
    }
}
