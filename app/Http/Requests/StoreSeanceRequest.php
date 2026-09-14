<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSeanceRequest extends FormRequest
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
        $modification = $this->route('seance') !== null;

        return [
            'film_id' => ['required', 'exists:films,id'],
            'date_heure' => $modification
                ? ['required', 'date']
                : ['required', 'date', 'after:now'],
            'tarif_fcfa' => ['required', 'integer', 'min:0'],
            'version' => ['required', 'in:VF,VO,VOSTFR,3D,3D-VF,3D-VOSTFR'],
            'age_minimum' => ['nullable', 'integer', 'min:0'],
            'categorie' => ['nullable', 'in:normale,competition,hors_competition,panorama'],
        ];
    }
}
