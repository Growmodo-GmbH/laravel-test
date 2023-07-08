<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    /**
     * Get the authenticated user's profile.
     *
     * @return JsonResponse
     */
    public function profile()
    {
        $user = Auth::user();

        return response()->json($user, 200);
    }

    /**
     * Get all users.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users, 200);
    }

    /**
     * Get a specific user by ID.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update a specific user.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json($user, 200);
    }

    /**
     * Delete a specific user.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User has been deleted!'], 200);
    }

    /**
     * Unsubscribe the authenticated user.
     *
     * @return JsonResponse
     */
    public function unsubscribe()
    {
        $user = Auth::user();
        $user->is_active = false;
        $user->save();

        return response()->json(['message' => 'You have successfully unsubscribed!'], 200);
    }
}
