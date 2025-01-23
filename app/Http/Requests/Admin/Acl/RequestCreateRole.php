<?php

namespace App\Http\Requests\Admin\Acl;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateRole extends FormRequest
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
            'name'       => 'required|string|min:2|max:20|unique:acl_roles,name',
            'guard_name' => 'required|string'
        ];
    }
}
