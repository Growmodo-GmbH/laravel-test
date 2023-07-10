<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * repository
 */
use App\Http\Controllers\Authentication\Repository\UserRepository as user_repo;

class UserController extends Controller
{
    //
    protected $user_repo;

    function __construct(
        user_repo $user_repo
    ){
        $this->user_repo = $user_repo;
    }

    public function get_all_users(Request $request){
        $with = [
            'get_role'
        ];
        return response()->json([
            'response'  => true,
            'data'      => $this->user_repo->get_all_users($with)->get()
        ]);
    }

    public function update_user_record($id = null, Request $request){
        $where = [
            'id'    => $id
        ];
        $update = $request->all();

        $this->user_repo->edit_user($where, $update);

        return response()->json([
            'response'  => true
        ], 200);
    }

    public function delete_record($id = null){
        $this->user_repo->delete_user($id);
        return response()->json([
            'response'  => true
        ], 200);
    }
}
