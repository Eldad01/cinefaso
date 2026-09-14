<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    /** @use HasFactory<\Database\Factories\FilmFactory> */
    use HasFactory;

    protected $fillable = [
        'titre',
        'titre_original',
        'duree_min',
        'annee',
        'langue',
        'genre',
        'synopsis',
        'affiche',
        'realisateur',
        'pays',
        'est_africain',
        'est_burkinabe',
        'prix_fespaco',
    ];

    protected function casts(): array
    {
        return [
            'annee' => 'integer',
            'est_africain' => 'boolean',
            'est_burkinabe' => 'boolean',
        ];
    }

    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }
}
