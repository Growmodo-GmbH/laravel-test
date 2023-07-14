<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * repository
 */
use App\Http\Controllers\Authentication\Repository\UserRepository as user_repo;

/**
 * requests
 */
use App\Http\Controllers\Authentication\Request\RegisterPayload as register_payload;
use App\Http\Controllers\Authentication\Request\LoginPayload as login_payload;

/**
 * service
 */
use App\Http\Controllers\Authentication\Service\UserService as logic_layer;

class AuthenticationController extends Controller
{
    //
    protected $user_repo;
    protected $logic_layer;

    function __construct(
        user_repo                   $user_repo,
        logic_layer                 $logic_layer
    ){
        $this->user_repo            = $user_repo;
        $this->logic_layer          = $logic_layer;
    }

    public function register(register_payload $request){
        $validated = $request->validated();

        $validated['password'] = $this->logic_layer->make_password($validated['password']);

        $validated['role_id'] = 2;

        $this->user_repo->create_user($validated);

        return response()->json([
            'response'  => true
        ], 200);
    }

    public function login(login_payload $request){
        $validated = $request->validated();
        
        if($this->logic_layer->login($validated)){
            $with = [
                'get_role'
            ];
            return response()->json([
                'response'  => true,
                'user'      => $this->user_repo->get_user(0, $with)->first(),
                'token'     => $this->logic_layer->create_token()->plainTextToken
            ], 200);
        }

        return response()->json([
            'response'  => false,
            'message'   => 'User does not exist'
        ], 422);

    }
}
