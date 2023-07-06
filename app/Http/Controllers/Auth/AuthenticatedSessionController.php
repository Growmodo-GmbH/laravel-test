<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{

    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token');

        return response(['auth-token' => $token->plainTextToken]);
    }

    public function destroy(): Response
    {
        return response()->noContent();
    }
}
