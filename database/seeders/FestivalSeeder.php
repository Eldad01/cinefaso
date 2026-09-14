<?php

namespace Database\Seeders;

use App\Models\Festival;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Festival::updateOrCreate(
            ['nom' => 'FESPACO', 'edition' => '31ᵉ édition'],
            [
                'date_debut' => now()->subDays(2)->toDateString(),
                'date_fin' => now()->addDays(5)->toDateString(),
                'description' => "Le Festival Panafricain du Cinéma et de la Télévision de Ouagadougou réunit chaque édition des centaines de films venus de tout le continent et de sa diaspora. Projections, avant-premières, débats et cérémonies rythment une semaine dédiée au 7ᵉ art africain.",
                'affiche' => null,
                'site_web' => 'https://www.fespaco.bf',
                'palmares' => null,
                'actif' => true,
            ]
        );

        Festival::updateOrCreate(
            ['nom' => 'FESPACO', 'edition' => '29ᵉ édition'],
            [
                'date_debut' => now()->subYears(2)->subDays(2)->toDateString(),
                'date_fin' => now()->subYears(2)->addDays(5)->toDateString(),
                'description' => "L'édition précédente du festival a mis à l'honneur les cinémas d'Afrique de l'Ouest, avec une programmation exceptionnelle de plus de 200 films.",
                'affiche' => null,
                'site_web' => 'https://www.fespaco.bf',
                'palmares' => "Étalon d'or de Yennenga : \"Sira\" (Apolline Traoré, Burkina Faso)\nÉtalon d'argent : \"Nafi's Father\" (Mamadou Dia, Sénégal)\nÉtalon de bronze : \"Freda\" (Gessica Généus, Haïti)\nPrix de la mise en scène : Alain Gomis\nPrix du meilleur scénario : Souleymane Cissé",
                'actif' => false,
            ]
        );

        Festival::updateOrCreate(
            ['nom' => 'Ciné Droit Libre Ouaga', 'edition' => 'Édition 2025'],
            [
                'date_debut' => now()->subMonths(6)->toDateString(),
                'date_fin' => now()->subMonths(6)->addDays(6)->toDateString(),
                'description' => "Festival international du film des droits humains, Ciné Droit Libre propose chaque année à Ouagadougou une sélection de documentaires et de fictions engagés, suivis de débats citoyens.",
                'affiche' => null,
                'site_web' => null,
                'palmares' => "Grand Prix : \"Le Silence des Urnes\" (documentaire, Burkina Faso)\nPrix du public : \"Terre Brûlée\" (Mali)",
                'actif' => false,
            ]
        );
    }
}
