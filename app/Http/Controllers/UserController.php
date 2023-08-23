<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function __construct()
    {
        try {
            ob_start('ob_gzhandler');
        } catch (\Exception $e) {
            //
        }
    }

    /**
     * Tap the guard we need.
     *
     * @param  string  $guard
     * @return middleware guard
     */
    protected function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }

    /**
     * Retreive the user by sanctum middleware.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        if (auth('sanctum')->check()) {
            return response()->json(auth('sanctum')->user());
        }
    }

    /**
     * Retreive the user by sanctum authtoken.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userByToken(Request $request)
    {
        $data = $request->validate([
            'token' => 'required|string|min:40',
        ]);

        $token = PersonalAccessToken::findToken($data['token']);
        $user = $token->tokenable;

        auth()->login($user);

        return response()->json($user);
    }
    
    public function toggleSubscribe(Request $request)
    {
        $data = $request->all();
        $user = User::findOrFail($data['user']['id']);
        if ($data['action'] == 'subscribe') {
            $user->subscribed = 1;
        } else {
            $user->subscribed = 0;
        }
        $user->save();
        $user->load('roles');

        return response()->json($user);
    }
}
