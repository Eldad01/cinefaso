<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EvenementResource extends JsonResource
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
            'titre' => $this->titre,
            'description' => $this->description,
            'type' => $this->type,
            'date_heure' => $this->date_heure->toIso8601String(),
            'affiche' => $this->affiche ? Storage::url($this->affiche) : null,
            'est_fespaco' => $this->est_fespaco,
            'lieu' => new LieuResource($this->whenLoaded('lieu')),
        ];
    }
}
