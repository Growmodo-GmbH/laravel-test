<?php

namespace App\Http\Controllers\Authentication\Repository;

/**
 * models
 */
use App\Models\User;
use Auth;

class UserRepository{
    public function create_user($data = []){
        return User::create($data);
    }

    public function get_user($id = 0, $with = []){
        if($id == 0){
            return User::query()
            ->with($with)
            ->where('id', Auth::user()->id);
        }
        return User::query()
        ->with($with)
        ->where('id', $id);
    }

    public function get_all_users($with = []){
        return User::query()
        ->with($with);
    }

    public function edit_user($where = [], $update = []){
        return User::query()
        ->where($where)
        ->update($update);
    }

    public function delete_user($id = null){
        return User::where('id', $id)->delete();
    }
}