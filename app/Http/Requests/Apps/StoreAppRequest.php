<?php

namespace App\Http\Requests\Apps;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'redirect_urls' => ['required', 'array', 'min:1'],
            'redirect_urls.*' => ['url'],
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'redirect_urls.required' => 'Redirect URLs are required.',
            'redirect_urls.array' => 'Redirect URLs must be an array.',
            'redirect_urls.min' => 'Client must have at least one redirect URL.',
            'redirect_urls.*.url' => 'Must be a valid URL.',
        ];
    }
}
