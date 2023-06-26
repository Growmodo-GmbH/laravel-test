<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request) {

        // Get authenticated/logged in user
        $user = Auth::user();

        // Deletes access token
        $user->currentAccessToken()->delete();

        return response()->json(['status' => 200, 'message' => 'User logged out!']);
    }
}
