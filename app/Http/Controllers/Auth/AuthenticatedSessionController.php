<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     *
     * @OA\Post(
     *     path="/login",
     *     @OA\Parameter(name="email", in="query", description="email", required=true,
     *        @OA\Schema(type="string")
     *    ),
     *     @OA\Parameter(name="password", in="query", description="password", required=true,
     *        @OA\Schema(type="string")
     *    ),
     *     @OA\Response(response=200, description="Handle an incoming authentication request.")
     * )
     */
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * @OA\Post(
    *     path="/logout",
     *     @OA\Response(response=200, description="Destroy an authenticated session..")
     * )
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
