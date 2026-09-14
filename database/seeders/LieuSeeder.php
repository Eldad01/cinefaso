<?php

namespace Database\Seeders;

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
                'nom' => 'CanalOlympia Idrissa Ouédraogo',
                'adresse' => 'Pissy, Ouagadougou',
                'telephone' => '+226 25 40 12 34',
                'description' => 'Salle moderne du réseau CanalOlympia, quartier Pissy.',
                'horaires' => 'Tous les jours, 14h - 23h',
                'tarifs' => 'À partir de 2000 FCFA',
            ],
            [
                'nom' => 'CanalOlympia Yennenga',
                'adresse' => 'Ouagadougou',
                'telephone' => '+226 25 40 56 78',
                'description' => 'Salle du réseau CanalOlympia, nommée en hommage à l\'Étalon de Yennenga.',
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
    }
}
