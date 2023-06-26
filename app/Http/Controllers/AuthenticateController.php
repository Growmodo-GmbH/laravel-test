<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    // Function for checking if user is authenticated
    public function auth () {
        $user = Auth::user();

        if (Auth::check()) {
            // Response with status
            return response()->json(['status' => 200, 'user' => $user]);
        } else {
            // Response with status and message
            return response()->json(['status' => 401, 'message' => "401 Unauthorized"]);
        }
    }

}
