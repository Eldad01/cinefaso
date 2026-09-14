<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LieuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'type' => $this->type,
            'adresse' => $this->adresse,
            'ville' => $this->ville,
            'telephone' => $this->telephone,
            'description' => $this->description,
            'horaires' => $this->horaires,
            'tarifs' => $this->tarifs,
            'photo' => $this->photo ? Storage::url($this->photo) : null,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'partenaire' => $this->partenaire,
            'active' => $this->active,
        ];
    }
}
