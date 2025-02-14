<?php

namespace App\Http\Requests\Admin\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateProduct extends FormRequest
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
            'name'        => 'required|string|min:2|max:199|unique:ec_products,name,'.$id,
            'status'      => 'required',
            'brand_id'    => 'required',
            'category_id' => 'required',
            'labels'      => 'nullable|array',
            'labels.*'    => 'integer|exists:ec_product_labels,id',
        ];
    }
}
