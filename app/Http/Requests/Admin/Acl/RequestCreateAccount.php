<?php

namespace App\Http\Requests\Admin\Acl;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:20',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[A-Z]/', // Must contain at least one uppercase letter
                'regex:/[a-z]/', // Must contain at least one lowercase letter
                'regex:/[0-9]/', // Must contain at least one number
            ],
        ];
    }
}
