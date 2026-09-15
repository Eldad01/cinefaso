<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSponsorRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:150'],
            'logo' => ['nullable', 'image', 'max:1024'],
            'site_web' => ['nullable', 'url', 'max:250'],
            'ordre' => ['nullable', 'integer', 'min:0'],
            'actif' => ['sometimes', 'boolean'],
        ];
    }
}
