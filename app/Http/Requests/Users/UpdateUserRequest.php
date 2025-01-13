<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route()->user->id)],
            'name' => ['sometimes', 'string', 'max:255'],
            'password' => ['sometimes', 'string', 'min:8', 'nullable'],
            'role' => ['sometimes', 'string', 'in:admin,user'],
            'clients' => ['sometimes', 'array', 'exists:oauth_clients,name'],
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'Email is required.',
            'email.string' => 'Email must be a string.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email must not be greater than 255 characters.',
            'email.unique' => 'Email must be unique.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 8 characters.',
            'role.in' => 'Role must be one of the following: admin, user.',
            'clients.array' => 'Clients must be an array.',
            'clients.exists' => 'Clients must exist.',
        ];
    }
}
