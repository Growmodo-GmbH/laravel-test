<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request){
        // make sure all the input data are valid
        $data = Validator::make($request->all(), [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)
                                 ->orWhere('username', $request->username);
                }),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)
                                 ->orWhere('username', $request->username);
                }),
            ],
            'phone_number' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);


        if ($data->fails()) {
            $success = false;
            $message = $data->errors();
        }else{
            $user = User::create([
                'username'     => $request->username,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'password'     => Hash::make($request->password)
            ]);
    
            $success = true;
            $message = "Register Successful";
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }

    public function login(Request $request)
    {
        // validate input
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginField = $request->input('login');

        // check if the login field is an email or username
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials[$fieldType] = $loginField;
        unset($credentials['login']);

        if (Auth::attempt($credentials)) {
            $user = User::where($fieldType, $credentials[$fieldType])->first();
            Auth::login($user);

            $success = true;
            $message = "Login successful";
        } else {
            $success = false;
            $message = "Invalid details";
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }

    public function getUser()
    {
        if(Auth::check()){
            return Auth::user();
        }else{
            return 'no user';
        }
    }

    public function logout(){
        try{
            Session::flush();
            $success = true;
            $message = "Logout successful";
        } catch(QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }
}

