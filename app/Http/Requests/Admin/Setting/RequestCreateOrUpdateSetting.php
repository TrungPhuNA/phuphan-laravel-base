<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateOrUpdateSetting extends FormRequest
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
            'manage_ads_setting' => 'nullable|string',
            'ads_client_id'      => 'nullable|string',
            'adsense_ads_file' => 'nullable|file|max:1024',
        ];
    }
}
