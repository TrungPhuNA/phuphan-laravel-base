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

    protected function prepareForValidation()
    {
        $this->merge([
            'seo_title'       => $this->seo_title ?? $this->name,
            'seo_description' => $this->seo_description ?? $this->description,
            'seo_image'       => $this->seo_image ?? $this->avatar ?? null, // Nếu seo_image null, kiểm tra avatar
            'seo_index'       => $this->seo_index ?? 0, // Mặc định là 1 (Index)
        ]);
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
            'name'            => 'required|string|min:5|max:199|unique:bl_articles,name,'.$id,
            'status'          => 'required',
            'menu_id'         => 'required',
            'description'     => 'required|string|min:5|max:199',
            'content'         => 'required',
            'seo_title'       => 'nullable|string|max:199',
            'seo_description' => 'nullable|string|max:500',
            'seo_image'       => 'nullable|string',
            'seo_index'       => 'nullable|boolean',
        ];
    }
}
