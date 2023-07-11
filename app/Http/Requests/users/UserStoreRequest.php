<?php

namespace App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'phone_number' => 'required|string',
            'password' => 'nullable',
        ];
    }
}
