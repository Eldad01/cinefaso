<?php

namespace Database\Seeders;

use App\Models\Festival;
use App\Models\Lieu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LieuSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $festivalActif = Festival::where('actif', true)->first();

        $lieux = [
            [
                'nom' => 'Ciné Burkina',
                'adresse' => 'Avenue Kwamé N\'Krumah, Centre-ville',
                'telephone' => '+226 25 30 68 71',
                'description' => 'Salle historique du centre-ville de Ouagadougou.',
                'horaires' => 'Tous les jours, 15h - 22h',
                'tarifs' => 'À partir de 1500 FCFA',
            ],
            [
                'nom' => 'Centre culturel du Faso Idrissa Ouédraogo (ex CanalOlympia)',
                'adresse' => 'Pissy, Ouagadougou',
                'telephone' => '+226 25 40 12 34',
                'description' => 'Salle moderne du quartier Pissy, anciennement CanalOlympia.',
                'horaires' => 'Tous les jours, 14h - 23h',
                'tarifs' => 'À partir de 2000 FCFA',
            ],
            [
                'nom' => 'Centre culturel du Faso Yennenga (ex CanalOlympia)',
                'adresse' => 'Ouagadougou',
                'telephone' => '+226 25 40 56 78',
                'description' => 'Salle nommée en hommage à l\'Étalon de Yennenga, anciennement CanalOlympia.',
                'horaires' => 'Tous les jours, 14h - 23h',
                'tarifs' => 'À partir de 2000 FCFA',
            ],
            [
                'nom' => 'Ciné Neerwaya',
                'adresse' => 'Cité An III, Ouagadougou',
                'telephone' => '+226 25 34 56 12',
                'description' => 'Salle de quartier populaire, cité An III.',
                'horaires' => 'Tous les jours, 15h - 22h',
                'tarifs' => 'À partir de 1000 FCFA',
            ],
            [
                'nom' => 'Petit Méliès — Institut Français',
                'adresse' => 'Avenue de la Nation, Ouagadougou',
                'telephone' => '+226 25 30 71 71',
                'description' => 'Salle de l\'Institut Français du Burkina Faso.',
                'horaires' => 'Mardi - Dimanche, 16h - 21h',
                'tarifs' => 'À partir de 1000 FCFA',
            ],
        ];

        foreach ($lieux as $data) {
            $lieu = Lieu::updateOrCreate(
                ['nom' => $data['nom']],
                [
                    'type' => 'salle_permanente',
                    'adresse' => $data['adresse'],
                    'ville' => 'Ouagadougou',
                    'telephone' => $data['telephone'],
                    'description' => $data['description'],
                    'horaires' => $data['horaires'],
                    'tarifs' => $data['tarifs'],
                    'partenaire' => true,
                    'active' => true,
                ]
            );

            $slug = Str::slug($data['nom']);

            User::updateOrCreate(
                ['email' => "gerant.{$slug}@cinefaso.bf"],
                [
                    'name' => $data['nom'],
                    'nom' => $data['nom'],
                    'role' => 'gerant',
                    'lieu_id' => $lieu->id,
                    'password' => Hash::make('CineFaso2026!'),
                    'email_verified_at' => now(),
                ]
            );
        }

        if ($festivalActif) {
            $lieuxTemporaires = [
                [
                    'nom' => 'Chapiteau FESPACO — Place de la Nation',
                    'adresse' => 'Place de la Nation, Ouagadougou',
                    'telephone' => '+226 25 30 63 70',
                    'description' => 'Grand chapiteau installé pour la durée du festival, dédié aux projections en plein air et aux cérémonies.',
                    'horaires' => 'Pendant le festival, 14h - minuit',
                    'tarifs' => 'À partir de 1000 FCFA',
                ],
                [
                    'nom' => 'Ciné Nazemse (site FESPACO)',
                    'adresse' => 'Secteur 30, Ouagadougou',
                    'telephone' => '+226 25 36 88 12',
                    'description' => 'Salle partenaire mobilisée en site additionnel pendant le festival pour les sélections compétition et panorama.',
                    'horaires' => 'Pendant le festival, 10h - 23h',
                    'tarifs' => 'À partir de 1500 FCFA',
                ],
            ];

            foreach ($lieuxTemporaires as $data) {
                $lieu = Lieu::updateOrCreate(
                    ['nom' => $data['nom']],
                    [
                        'type' => 'lieu_temporaire',
                        'adresse' => $data['adresse'],
                        'ville' => 'Ouagadougou',
                        'telephone' => $data['telephone'],
                        'description' => $data['description'],
                        'horaires' => $data['horaires'],
                        'tarifs' => $data['tarifs'],
                        'festival_id' => $festivalActif->id,
                        'partenaire' => true,
                        'active' => true,
                    ]
                );

                $slug = Str::slug($data['nom']);

                User::updateOrCreate(
                    ['email' => "gerant.{$slug}@cinefaso.bf"],
                    [
                        'name' => $data['nom'],
                        'nom' => $data['nom'],
                        'role' => 'gerant',
                        'lieu_id' => $lieu->id,
                        'password' => Hash::make('CineFaso2026!'),
                        'email_verified_at' => now(),
                    ]
                );
            }
        }
    }
}
