<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class RegisterController extends Controller
{

    public function store(Request $request) {
        $input = $request->all();

        $username = User::where('username', $request['username'])->first();;

        $email = User::where('email', $request['email'])->first();;

        if ($username) {
            return response()->json(['status' => 409, 'message' => "Username already exist, please try again!"]);
        } else if ($email) {
            return response()->json(['status' => 409, 'message' => "Email address already exist, please try again!"]);
        } else if(!$username && !$email) {
            // Create users information
        User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'],
            'password' => Hash::make($input['password'])
        ]);

            // Response with status and message
            return response()->json(['status' => 200, 'message' => "User successfully added!"]);
        }
    }
}
