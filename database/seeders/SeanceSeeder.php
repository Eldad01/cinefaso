<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Lieu;
use App\Models\Seance;
use Illuminate\Database\Seeder;

class SeanceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $lieux = Lieu::all();
        $films = Film::all();

        if ($lieux->isEmpty() || $films->isEmpty()) {
            return;
        }

        $heures = ['15:00', '18:00', '20:30'];
        $versions = ['VF', 'VOSTFR', 'VO'];

        for ($jour = 0; $jour < 7; $jour++) {
            $date = now()->addDays($jour)->startOfDay();

            foreach ($lieux as $lieuIndex => $lieu) {
                $film = $films[($jour + $lieuIndex) % $films->count()];
                $heure = $heures[($jour + $lieuIndex) % count($heures)];
                $version = $versions[($jour + $lieuIndex) % count($versions)];

                [$h, $m] = explode(':', $heure);

                Seance::updateOrCreate(
                    [
                        'lieu_id' => $lieu->id,
                        'film_id' => $film->id,
                        'date_heure' => $date->copy()->setTime((int) $h, (int) $m),
                    ],
                    [
                        'tarif_fcfa' => 1500,
                        'version' => $version,
                        'categorie' => 'normale',
                        'active' => true,
                    ]
                );
            }
        }
    }
}
