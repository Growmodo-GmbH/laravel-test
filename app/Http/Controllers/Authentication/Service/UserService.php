<?php

namespace App\Http\Controllers\Authentication\Service;

use Hash;
use Auth;

class UserService{
    public function make_password($password = null){
        return Hash::make($password);
    }

    public function login($data){
        return Auth::attempt($data);
    }

    public function create_token(){
        $user = Auth::user();
        return $user->createToken($user->name);
    }
    
}