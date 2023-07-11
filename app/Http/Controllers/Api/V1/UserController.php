<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\users\UserStoreRequest;
use App\Http\Requests\users\UserUpdateRequest;
use App\Http\Resources\Api\V1\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = UserResource::collection(User::all());

        return response([
            'users' => $users,
        ], 200);
    }

    public function store(UserStoreRequest $request)
    {
        $user = new UserResource((new UserService())->store($request->validated()));

        return response([
            'user' => $user
        ], 200);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = new UserResource((new UserService())->update($request->validated(), $id));

        return response([
            'user' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        (new UserService())->destroy($id);

        return response(200);
    }
}
