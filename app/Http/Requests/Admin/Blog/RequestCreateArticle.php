<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateArticle extends FormRequest
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
        $id = $this->id ? $this->id : null;
        return [
            'name'        => 'required|string|min:5|max:199|unique:bl_articles,name,'.$id,
            'status'      => 'required',
            'menu_id'     => 'required',
            'description' => 'required|string|min:5|max:199',
            'content'     => 'required',
        ];
    }
}
