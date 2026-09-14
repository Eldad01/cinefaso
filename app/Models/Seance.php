<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seance extends Model
{
    /** @use HasFactory<\Database\Factories\SeanceFactory> */
    use HasFactory;

    protected $fillable = [
        'lieu_id',
        'film_id',
        'festival_id',
        'date_heure',
        'tarif_fcfa',
        'version',
        'age_minimum',
        'categorie',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'date_heure' => 'datetime',
            'active' => 'boolean',
        ];
    }

    public function lieu(): BelongsTo
    {
        return $this->belongsTo(Lieu::class);
    }

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    public function festival(): BelongsTo
    {
        return $this->belongsTo(Festival::class);
    }

    public function rappels(): HasMany
    {
        return $this->hasMany(Rappel::class);
    }
}
