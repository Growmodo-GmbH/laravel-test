<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ['required', 'min:4'],
            "email" => ['required', 'email', Rule::unique('record', 'email')],
            "phone" => ['required','digits:11', Rule::unique('record', 'phone')],
            "password" => 'required|confirmed|min:6',
        ]);
        $validated['password'] = bcrypt( $validated['password']);
        $validated['usertype'] = 1;
        User::create($validated);
        return response()->json([
            'status' => true,
            'message' => "Registation Success"

        ]);
    }
}
