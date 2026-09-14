<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evenement extends Model
{
    /** @use HasFactory<\Database\Factories\EvenementFactory> */
    use HasFactory;

    protected $fillable = [
        'lieu_id',
        'festival_id',
        'titre',
        'description',
        'type',
        'date_heure',
        'affiche',
        'est_fespaco',
    ];

    protected function casts(): array
    {
        return [
            'date_heure' => 'datetime',
            'est_fespaco' => 'boolean',
        ];
    }

    public function lieu(): BelongsTo
    {
        return $this->belongsTo(Lieu::class);
    }

    public function festival(): BelongsTo
    {
        return $this->belongsTo(Festival::class);
    }
}
