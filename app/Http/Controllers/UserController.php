<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Function for getting all users

    public function get() {

        // Get all users
        $users = User::all()->except(Auth::id());

        // Response with status and user's informations into json format
        return response()->json(['status' => 200, 'users' => $users]);
    }


    // Function for getting a single user/authenticated user
    public function getUser() {

        // Get authenticated user
        $user = Auth::user();

        // Check if user is authenticated
        if (Auth::check()) {

            // Response with status and user details
            return response()->json(['status' => 200, 'user' => $user]);
        } else {
            // Response with status and message
            return response()->json(['status' => 401, 'message' => "401 Unauthorized"]);
        }

        // Response with status and message
        return response()->json(['status' => 403, 'message' => "403 Forbidden"]);
    }

    // Function for getting a single user/authenticated user
    public function getUserById($id) {

        // Get authenticated user
        $user = User::findOrFail($id);

        // Check if user is authenticated
        if ($user) {

            // Response with status and user details
            return response()->json(['status' => 200, 'user' => $user]);
        } else {
            // Response with status and message
            return response()->json(['status' => 401, 'message' => "401 Unauthorized"]);
        }

        // Response with status and message
        return response()->json(['status' => 403, 'message' => "403 Forbidden"]);
    }


    public function deleteUser($id) {

        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
            $user->tokens()->delete();

            return response()->json(['status' => 200, 'message' => 'User has been deleted!']);
        }

        return response()->json(['status' => 404, 'message' => 'User not found!']);

    }

    public function editUser(Request $request, $id) {

        $user = User::find($id);

        if ($user) {
            $user->Update($request->all());

            return response()->json(['status' => 200, 'message' => 'User has been update!',]);

        }

        return response()->json(['status' => 404, 'message' => 'User not found!']);
    }
}
