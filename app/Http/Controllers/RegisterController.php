<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()], 422);
        }

        $this->create($request->all());
        return response()->json(['status' => 200, 'message' => 'Registration successful'], 200);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'contact' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'email.unique' => 'Email already exists.',
            'username.unique' => 'Username already exists.',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
