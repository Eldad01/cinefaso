<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $articles = [
            [
                'titre' => 'Le FESPACO ouvre ses portes à Ouagadougou',
                'type' => 'actualite',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "La capitale du cinéma africain vibre à nouveau cette semaine avec l'ouverture officielle du festival. Des centaines de professionnels venus de tout le continent sont attendus pour cette nouvelle édition, marquée par une compétition officielle particulièrement relevée et une programmation qui fait la part belle aux jeunes réalisateurs.",
            ],
            [
                'titre' => 'Portrait : Fanta Régina Nacro, pionnière du cinéma burkinabè',
                'type' => 'portrait',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "Première femme cinéaste d'Afrique subsaharienne à réaliser un long-métrage de fiction, Fanta Régina Nacro a ouvert la voie à toute une génération de réalisatrices. Retour sur un parcours consacré à raconter les histoires de femmes burkinabè.",
            ],
            [
                'titre' => 'Portrait : Gaston Kaboré, la mémoire du cinéma africain',
                'type' => 'portrait',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "Réalisateur de Wênd Kûuni et de Buud Yam, Gaston Kaboré est aussi le fondateur de l'Institut Imagine, dédié à la formation des jeunes cinéastes africains. Portrait d'un cinéaste qui a fait du patrimoine africain la matière première de son œuvre.",
            ],
            [
                'titre' => 'Restauration de Yaaba : un classique retrouve son éclat',
                'type' => 'actualite',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "Le chef-d'œuvre d'Idrissa Ouédraogo, primé à Cannes en 1989, vient de bénéficier d'une restauration numérique complète. Il sera projeté dans sa version restaurée dans plusieurs salles partenaires de CinéFaso dans les semaines à venir.",
            ],
            [
                'titre' => 'Palmarès complet de la 29ᵉ édition du FESPACO',
                'type' => 'palmares',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "Retour sur le palmarès complet de la précédente édition, remportée par le film \"Sira\" de la réalisatrice burkinabè Apolline Traoré, qui décroche l'Étalon d'or de Yennenga face à une sélection particulièrement disputée.",
            ],
            [
                'titre' => 'CinéFaso lance son service de rappel par SMS',
                'type' => 'actualite',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "Pour ne plus manquer une séance, il est désormais possible d'activer un rappel par SMS directement depuis la fiche de chaque film. Un message est envoyé automatiquement avant le début de la séance choisie.",
            ],
            [
                'titre' => 'Portrait : Apolline Traoré, cheffe de file du nouveau cinéma burkinabè',
                'type' => 'portrait',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "Première réalisatrice burkinabè à remporter l'Étalon d'or de Yennenga avec \"Sira\", Apolline Traoré s'impose comme une voix majeure du cinéma ouest-africain contemporain, entre engagement social et sens du spectacle.",
            ],
            [
                'titre' => 'Moolaadé fête ses 20 ans sur grand écran',
                'type' => 'actualite',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "Vingt ans après sa sélection à Cannes, le film d'Ousmane Sembène est de nouveau à l'affiche dans plusieurs salles partenaires. L'occasion de redécouvrir un classique du cinéma engagé africain.",
            ],
            [
                'titre' => 'Trois nouvelles salles rejoignent le réseau CinéFaso',
                'type' => 'actualite',
                'auteur' => 'Rédaction CinéFaso',
                'contenu' => "Le réseau de salles partenaires continue de s'étoffer à Ouagadougou, avec pour objectif de couvrir l'ensemble des quartiers de la capitale et de rapprocher le cinéma du plus grand nombre.",
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(
                ['titre' => $data['titre']],
                [
                    'contenu' => $data['contenu'],
                    'type' => $data['type'],
                    'auteur' => $data['auteur'],
                    'photo' => null,
                    'publie' => true,
                ]
            );
        }
    }
}
