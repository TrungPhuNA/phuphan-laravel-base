<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdatePassword extends FormRequest
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
            'password' => [
                'required',
                'string',
                'min:8', // ít nhất 8 ký tự
                'regex:/[a-z]/', // ít nhất 1 chữ thường
                'regex:/[A-Z]/', // ít nhất 1 chữ in hoa
                'regex:/[0-9]/', // ít nhất 1 so
            ],
            're_password' => 'required|same:password',
        ];
    }
}
