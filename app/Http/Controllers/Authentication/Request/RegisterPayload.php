<?php

namespace App\Http\Controllers\Authentication\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterPayload extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'email'             => 'required|email|unique:users',
            'name'              => 'required|string',
            'username'          => 'required|string|unique:users',
            'password'          => 'required|string',
            'phone_number'      => 'required|string|unique:users'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'response'          => false,
            'message'           => 'Validation Error',
            'data'              => $validator->errors()
        ], 422));
    }

    public function messages(){
        return [
            'email.required'        => 'Email is required',
            'email.unique'          => 'Email is already taken',
            'name.required'         => 'Name is required',
            'password.required'     => 'Password is required',
            'username.unique'       => 'username is already taken!',
            'phone_number.unique'   => 'Phone number already taken!'
        ];
    }

}