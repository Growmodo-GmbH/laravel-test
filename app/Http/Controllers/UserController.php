<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/users",
     *     @OA\Response(response=200, description="Endpoint to get all user")
     * )
     */
    public function all()
    {
        $userList = User::all();

        return response()->json($userList);
    }
}
