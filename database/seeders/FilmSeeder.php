<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $films = [
            [
                'titre' => 'Tilaï',
                'duree_min' => 81,
                'annee' => 1990,
                'langue' => 'Mooré',
                'genre' => 'Drame',
                'synopsis' => 'De retour dans son village après une longue absence, Saga découvre que celle qui lui était promise a épousé son père.',
                'realisateur' => 'Idrissa Ouédraogo',
                'pays' => 'Burkina Faso',
                'est_africain' => true,
                'est_burkinabe' => true,
                'prix_fespaco' => 'Grand Prix du Jury - Cannes 1990',
            ],
            [
                'titre' => 'Saaraba',
                'duree_min' => 90,
                'annee' => 1991,
                'langue' => 'Français',
                'genre' => 'Drame',
                'synopsis' => 'Un jeune homme revient dans son pays natal après des études en Europe, en quête d\'un idéal.',
                'realisateur' => 'Amadou Saalum Seck',
                'pays' => 'Sénégal',
                'est_africain' => true,
                'est_burkinabe' => false,
                'prix_fespaco' => null,
            ],
            [
                'titre' => 'Wênd Kûuni',
                'titre_original' => 'Le don de Dieu',
                'duree_min' => 75,
                'annee' => 1982,
                'langue' => 'Mooré',
                'genre' => 'Drame',
                'synopsis' => 'Un jeune garçon muet recueilli par une famille recouvre la parole après un drame.',
                'realisateur' => 'Gaston Kaboré',
                'pays' => 'Burkina Faso',
                'est_africain' => true,
                'est_burkinabe' => true,
                'prix_fespaco' => 'Étalon de Yennenga 1983',
            ],
            [
                'titre' => 'Le Damier',
                'titre_original' => 'Papa National Oyé',
                'duree_min' => 90,
                'annee' => 1996,
                'langue' => 'Français',
                'genre' => 'Comédie dramatique',
                'synopsis' => 'Une satire du pouvoir africain à travers une partie de jeu de dames.',
                'realisateur' => 'Dani Kouyaté',
                'pays' => 'Burkina Faso',
                'est_africain' => true,
                'est_burkinabe' => true,
                'prix_fespaco' => null,
            ],
            [
                'titre' => 'Yaaba',
                'duree_min' => 90,
                'annee' => 1989,
                'langue' => 'Mooré',
                'genre' => 'Drame',
                'synopsis' => 'Deux enfants se lient d\'amitié avec une vieille femme rejetée par son village.',
                'realisateur' => 'Idrissa Ouédraogo',
                'pays' => 'Burkina Faso',
                'est_africain' => true,
                'est_burkinabe' => true,
                'prix_fespaco' => 'Prix de la Critique Internationale - Cannes 1989',
            ],
            [
                'titre' => 'Keïta ! L\'héritage du griot',
                'duree_min' => 94,
                'annee' => 1995,
                'langue' => 'Français',
                'genre' => 'Drame',
                'synopsis' => 'Un griot initie un jeune garçon à la légende de Soundiata Keïta.',
                'realisateur' => 'Dani Kouyaté',
                'pays' => 'Burkina Faso',
                'est_africain' => true,
                'est_burkinabe' => true,
                'prix_fespaco' => 'Étalon de Yennenga 1997',
            ],
            [
                'titre' => 'Sarraounia',
                'duree_min' => 122,
                'annee' => 1986,
                'langue' => 'Français',
                'genre' => 'Historique',
                'synopsis' => 'La résistance d\'une reine guerrière face à la colonisation française.',
                'realisateur' => 'Med Hondo',
                'pays' => 'Burkina Faso / Mauritanie',
                'est_africain' => true,
                'est_burkinabe' => true,
                'prix_fespaco' => 'Étalon de Yennenga 1987',
            ],
            [
                'titre' => 'Buud Yam',
                'duree_min' => 100,
                'annee' => 1997,
                'langue' => 'Mooré',
                'genre' => 'Aventure',
                'synopsis' => 'Suite de Wênd Kûuni, un jeune homme part à la recherche d\'un remède pour sa sœur.',
                'realisateur' => 'Gaston Kaboré',
                'pays' => 'Burkina Faso',
                'est_africain' => true,
                'est_burkinabe' => true,
                'prix_fespaco' => 'Étalon de Yennenga 1997',
            ],
            [
                'titre' => 'Dune : Deuxième Partie',
                'titre_original' => 'Dune: Part Two',
                'duree_min' => 166,
                'annee' => 2024,
                'langue' => 'VOSTFR',
                'genre' => 'Science-fiction',
                'synopsis' => 'Paul Atréides s\'unit à Chani et aux Fremen pour se venger des conspirateurs qui ont détruit sa famille.',
                'realisateur' => 'Denis Villeneuve',
                'pays' => 'États-Unis',
                'est_africain' => false,
                'est_burkinabe' => false,
                'prix_fespaco' => null,
            ],
            [
                'titre' => 'Inside Out 2',
                'titre_original' => 'Vice-versa 2',
                'duree_min' => 96,
                'annee' => 2024,
                'langue' => 'VF',
                'genre' => 'Animation',
                'synopsis' => 'Riley entre dans l\'adolescence et de nouvelles émotions font leur apparition.',
                'realisateur' => 'Kelsey Mann',
                'pays' => 'États-Unis',
                'est_africain' => false,
                'est_burkinabe' => false,
                'prix_fespaco' => null,
            ],
        ];

        foreach ($films as $data) {
            Film::updateOrCreate(
                ['titre' => $data['titre'], 'annee' => $data['annee']],
                $data
            );
        }
    }
}
