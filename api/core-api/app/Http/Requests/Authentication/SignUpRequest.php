<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:256',
            'last_name' => 'required|string|max:256',
            'email' => 'required|string|email|max:256|unique:users',
            'password' => [
                'required', 
                'string', 
                Password::min(8)->max(256)->numbers()->mixedCase(),
                'confirmed'
            ],
        ];
    }
}
