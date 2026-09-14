<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FestivalResource extends JsonResource
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
            'edition' => $this->edition,
            'date_debut' => $this->date_debut->toDateString(),
            'date_fin' => $this->date_fin->toDateString(),
            'description' => $this->description,
            'affiche' => $this->affiche ? Storage::url($this->affiche) : null,
            'site_web' => $this->site_web,
            'palmares' => $this->palmares,
            'actif' => $this->actif,
        ];
    }
}
