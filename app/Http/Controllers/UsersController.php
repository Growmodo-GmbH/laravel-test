<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\GetUserRolesRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\Users\RolesCollection;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('role:admin');

        try {
            ob_start('ob_gzhandler');
        } catch (\Exception $e) {
            //
        }
    }

    public function users(Request $request)
    {
        $per = 10;
        if ($request->has('per')) {
            $per = $request->input('per');
        }

        $users = User::whereHas('roles', function($query) {
            $query->where('level', 2);
        })->paginate($per);

        return response()->json($users);
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required|unique:users,name,'.$user->id,
            'password'  => 'min:6|max:255|confirmed',
            'phone_number'  => 'integer',
        ]);

        $validated = $request->validated();

        $data = $request->only('name', 'email', 'phone_number', 'subscribed', 'password');
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'user'  => $user,
        ]);
    }

    public function deleteUser(Request $request, User $user)
    {
        $user->delete();

        return response()->json($user);
    }
}
