<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rappel extends Model
{
    /** @use HasFactory<\Database\Factories\RappelFactory> */
    use HasFactory;

    protected $fillable = [
        'seance_id',
        'telephone',
        'token',
        'notifie',
    ];

    protected function casts(): array
    {
        return [
            'notifie' => 'boolean',
        ];
    }

    public function seance(): BelongsTo
    {
        return $this->belongsTo(Seance::class);
    }
}
