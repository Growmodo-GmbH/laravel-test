<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show(){

        $users = User::all();

        // Format the created_at field of each user
        foreach ($users as $user) {
            $user->formatted_created_at = Carbon::parse($user->created_at)->timezone('Asia/Manila')->format('Y-m-d h:i A');
        }

        return response()->json(['users' => $users]);
    }

    public function edit(Request $request, User $user){
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)
                                 ->orWhere('username', $request->username);
                })->ignore($user),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)
                                 ->orWhere('username', $request->username);
                })->ignore($user),
            ],
            'phone_number' => 'required',
        ]);

        $user->update($request->only(['username', 'email', 'phone_number']));

        return response()->json(['message' => 'User updated successfully']);
    }

    public function delete(User $user){
        // $user->delete();
        
        return response()->json(['message' => 'User deleted successfully']);
    }
}
