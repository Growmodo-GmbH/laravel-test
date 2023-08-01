<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // get all users

    public function get()
    {
        $users = User::where('id', '<>', Auth::id())->get();
        return response()->json(['status' => 200, 'users' => $users], 200);
    }

    // get authenticated user
    public function getUsers()
    {
        $user = Auth::user();
        if (Auth::check()) {
            return response()->json(['status' => 200, 'user' => $user], 200);
        } else {
            return response()->json(['status' => 401, 'message' => "401 Unauthorized"], 401);
        }

        return response()->json(['status' => 403, 'message' => "403 Forbidden"], 403);
    }

    //get user by id
    public function getUserByID($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['status' => 200, 'user' => $user], 200);
        }

        return response()->json(['status' => 403, 'message' => "403 Forbidden"], 403);
    }

    public function editUser(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($request->all());
            return response()->json(['status' => 200, 'message' => 'User has been updated!', 'user' => $user], 200);
        }

        return response()->json(['status' => 404, 'message' => 'User not found!'], 404);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->tokens()->delete();
            $user->delete();
            return response()->json(['status' => 200, 'message' => 'User deleted successfully.'], 200);
        }

        return response()->json(['status' => 404, 'message' => 'User does not exist.'], 404);
    }
}
