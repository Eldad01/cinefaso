<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
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
            'titre' => ['required', 'string', 'max:200'],
            'titre_original' => ['nullable', 'string', 'max:200'],
            'duree_min' => ['required', 'integer', 'min:1'],
            'annee' => ['required', 'integer', 'min:1900', 'max:'.(date('Y') + 1)],
            'langue' => ['required', 'string', 'max:100'],
            'genre' => ['required', 'string', 'max:150'],
            'synopsis' => ['nullable', 'string'],
            'affiche' => ['nullable', 'image', 'max:2048'],
            'realisateur' => ['required', 'string', 'max:150'],
            'pays' => ['required', 'string', 'max:100'],
            'est_africain' => ['sometimes', 'boolean'],
            'est_burkinabe' => ['sometimes', 'boolean'],
            'prix_fespaco' => ['nullable', 'string', 'max:250'],
        ];
    }
}
