<?php

namespace App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email,' . request('id'),
            'phone_number' => 'required|string',
            'password' => 'nullable',
        ];
    }
}
