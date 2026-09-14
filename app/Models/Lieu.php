<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lieu extends Model
{
    /** @use HasFactory<\Database\Factories\LieuFactory> */
    use HasFactory;

    protected $table = 'lieux';

    protected $fillable = [
        'nom',
        'type',
        'adresse',
        'ville',
        'telephone',
        'description',
        'horaires',
        'tarifs',
        'photo',
        'latitude',
        'longitude',
        'festival_id',
        'partenaire',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'partenaire' => 'boolean',
            'active' => 'boolean',
        ];
    }

    public function festival(): BelongsTo
    {
        return $this->belongsTo(Festival::class);
    }

    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }

    public function evenements(): HasMany
    {
        return $this->hasMany(Evenement::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
