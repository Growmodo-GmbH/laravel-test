<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    // user authentication
    public function authenticate()
    {
        $user = Auth::user();

        if (Auth::check()) {
            return response()->json(['status' => 200, 'user' => $user], 200);
        } else {
            return response()->json(['status' => 401,'message' => "401 Unauthorized"], 401);
        }
    }
}
