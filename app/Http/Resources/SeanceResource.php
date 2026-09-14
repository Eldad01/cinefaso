<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeanceResource extends JsonResource
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
            'date_heure' => $this->date_heure->toIso8601String(),
            'tarif_fcfa' => $this->tarif_fcfa,
            'version' => $this->version,
            'age_minimum' => $this->age_minimum,
            'categorie' => $this->categorie,
            'active' => $this->active,
            'film' => new FilmResource($this->whenLoaded('film')),
            'lieu' => new LieuResource($this->whenLoaded('lieu')),
        ];
    }
}
