<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FilmResource extends JsonResource
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
            'titre_original' => $this->titre_original,
            'duree_min' => $this->duree_min,
            'annee' => $this->annee,
            'langue' => $this->langue,
            'genre' => $this->genre,
            'synopsis' => $this->synopsis,
            'affiche' => $this->affiche ? Storage::url($this->affiche) : null,
            'realisateur' => $this->realisateur,
            'pays' => $this->pays,
            'est_africain' => $this->est_africain,
            'est_burkinabe' => $this->est_burkinabe,
            'prix_fespaco' => $this->prix_fespaco,
        ];
    }
}
