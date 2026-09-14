<?php

namespace Database\Seeders;

use App\Models\Evenement;
use App\Models\Festival;
use App\Models\Lieu;
use Illuminate\Database\Seeder;

class EvenementSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cineBurkina = Lieu::where('nom', 'Ciné Burkina')->first();
        $petitMelies = Lieu::where('nom', 'Petit Méliès — Institut Français')->first();
        $centreYennenga = Lieu::where('nom', 'Centre culturel du Faso Yennenga (ex CanalOlympia)')->first();
        $cineNeerwaya = Lieu::where('nom', 'Ciné Neerwaya')->first();
        $chapiteauFespaco = Lieu::where('nom', 'Chapiteau FESPACO — Place de la Nation')->first();

        $festivalActif = Festival::where('actif', true)->first();

        $evenements = [
            [
                'titre' => "Cérémonie d'ouverture du FESPACO",
                'description' => "Soirée d'ouverture du festival, en présence des autorités, des réalisateurs en compétition et des invités d'honneur.",
                'type' => 'ceremonie',
                'date_heure' => $festivalActif?->date_debut?->copy()->setTime(19, 0) ?? now()->addDays(1)->setTime(19, 0),
                'lieu_id' => $chapiteauFespaco?->id,
                'festival_id' => $festivalActif?->id,
                'est_fespaco' => true,
            ],
            [
                'titre' => 'Rencontre avec Dani Kouyaté',
                'description' => "Échange avec le réalisateur burkinabè autour de son œuvre, suivi d'une séance de dédicaces.",
                'type' => 'debat',
                'date_heure' => now()->addDays(2)->setTime(17, 0),
                'lieu_id' => $petitMelies?->id,
                'festival_id' => $festivalActif?->id,
                'est_fespaco' => true,
            ],
            [
                'titre' => 'Avant-première : Le Fils de Ouaga',
                'description' => "Projection en avant-première du dernier long-métrage burkinabè, en présence de l'équipe du film.",
                'type' => 'avant_premiere',
                'date_heure' => now()->addDays(4)->setTime(19, 30),
                'lieu_id' => $cineBurkina?->id,
                'festival_id' => null,
                'est_fespaco' => false,
            ],
            [
                'titre' => "Cérémonie de clôture — Étalon de Yennenga",
                'description' => "Remise des prix de la compétition officielle et clôture du festival.",
                'type' => 'ceremonie',
                'date_heure' => $festivalActif?->date_fin?->copy()->setTime(19, 0) ?? now()->addDays(5)->setTime(19, 0),
                'lieu_id' => $chapiteauFespaco?->id,
                'festival_id' => $festivalActif?->id,
                'est_fespaco' => true,
            ],
            [
                'titre' => 'Projection spéciale : Nuit du cinéma burkinabè',
                'description' => "Une nuit entière consacrée aux classiques du cinéma national : Yaaba, Tilaï, Wênd Kûuni.",
                'type' => 'projection_speciale',
                'date_heure' => now()->addDays(18)->setTime(20, 0),
                'lieu_id' => $centreYennenga?->id,
                'festival_id' => null,
                'est_fespaco' => false,
            ],
            [
                'titre' => 'Avant-première : Sahel Horizon',
                'description' => "Découverte en avant-première d'un nouveau documentaire sur la jeunesse sahélienne.",
                'type' => 'avant_premiere',
                'date_heure' => now()->addDays(33)->setTime(19, 0),
                'lieu_id' => $cineNeerwaya?->id,
                'festival_id' => null,
                'est_fespaco' => false,
            ],
        ];

        foreach ($evenements as $data) {
            if (! $data['lieu_id']) {
                continue;
            }

            Evenement::updateOrCreate(
                ['titre' => $data['titre'], 'date_heure' => $data['date_heure']],
                $data
            );
        }
    }
}
