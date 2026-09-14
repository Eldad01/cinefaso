<?php

namespace Database\Seeders;

use App\Models\Festival;
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
        $lieuxPermanents = Lieu::where('type', 'salle_permanente')->get();
        $films = Film::all();

        if ($lieuxPermanents->isEmpty() || $films->isEmpty()) {
            return;
        }

        $heures = ['15:00', '18:00', '20:30'];
        $versions = ['VF', 'VOSTFR', 'VO'];

        for ($jour = 0; $jour < 7; $jour++) {
            $date = now()->addDays($jour)->startOfDay();

            foreach ($lieuxPermanents as $lieuIndex => $lieu) {
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

        $this->seedSeancesFestival($films);
    }

    /**
     * Programme de projections du festival actif dans ses lieux temporaires.
     */
    private function seedSeancesFestival($films): void
    {
        $festival = Festival::where('actif', true)->first();
        $lieuxFestival = Lieu::where('type', 'lieu_temporaire')->where('festival_id', $festival?->id)->get();

        if (! $festival || $lieuxFestival->isEmpty()) {
            return;
        }

        $categories = ['competition', 'hors_competition', 'panorama'];
        $heures = ['14:00', '17:00', '20:00'];
        $dureeFestivalJours = (int) $festival->date_debut->diffInDays($festival->date_fin);

        $seanceIndex = 0;

        foreach ($lieuxFestival as $lieu) {
            for ($jour = 0; $jour <= $dureeFestivalJours; $jour++) {
                $date = $festival->date_debut->copy()->addDays($jour);

                if ($date->isPast() && ! $date->isToday()) {
                    continue;
                }

                foreach ($heures as $heureIndex => $heure) {
                    $film = $films[$seanceIndex % $films->count()];
                    $categorie = $categories[$seanceIndex % count($categories)];
                    [$h, $m] = explode(':', $heure);

                    Seance::updateOrCreate(
                        [
                            'lieu_id' => $lieu->id,
                            'film_id' => $film->id,
                            'date_heure' => $date->copy()->setTime((int) $h, (int) $m),
                        ],
                        [
                            'festival_id' => $festival->id,
                            'tarif_fcfa' => 1000,
                            'version' => 'VOSTFR',
                            'categorie' => $categorie,
                            'active' => true,
                        ]
                    );

                    $seanceIndex++;
                }
            }
        }
    }
}
