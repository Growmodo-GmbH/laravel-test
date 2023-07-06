<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show(){
        $users = User::all();

        return $users;
    }

    public function edit(Request $request, User $user){
        $data = Validator::make($request->all(), [
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

        if ($data->fails()) {
            $success = false;
            $message = $data->errors();
        }else{
            $user->update($request->only(['username', 'email', 'phone_number']));
            $success = true;
            $message = "User updated successfully";
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }

    public function delete(User $user){
        $user->delete();
        
        $response = [
            'success' => true,
            'message' => "User deleted successfully"
        ];

        return response()->json($response);
    }
}
