<?php

namespace App\Http\Controllers\Authentication\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginPayload extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'email'         => 'sometimes|email',
            'username'      => 'sometimes|string',
            'password'      => 'required|string'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'response'  => false,
            'message'   => 'Validation Error!',
            'data'      => $validator->errors()
        ], 422));
    }

    public function messages(){
        return [
            'password.required'     => 'password is required',
            'username.sometimes'    => 'email or username is requried',
            'email.sometimes'       => 'email or username is required'
        ];
    }
}