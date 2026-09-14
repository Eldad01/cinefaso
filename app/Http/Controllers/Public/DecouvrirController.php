<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Festival;
use App\Models\Film;
use Illuminate\View\View;

class DecouvrirController extends Controller
{
    public function index(): View
    {
        $filmsBurkinabe = Film::where('est_burkinabe', true)
            ->orderByDesc('prix_fespaco')
            ->orderByDesc('annee')
            ->get();

        $filmsAfricains = Film::where('est_africain', true)
            ->orderByDesc('annee')
            ->take(8)
            ->get();

        $realisateurs = $filmsBurkinabe
            ->groupBy('realisateur')
            ->map(fn ($films, $nom) => [
                'nom' => $nom,
                'films' => $films->pluck('titre'),
            ])
            ->values();

        $festivalActif = Festival::where('actif', true)->first();

        $palmares = Festival::whereNotNull('palmares')
            ->orderByDesc('date_debut')
            ->get();

        $articles = Article::where('publie', true)
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        return view('public.decouvrir', [
            'filmsBurkinabe' => $filmsBurkinabe,
            'filmsAfricains' => $filmsAfricains,
            'realisateurs' => $realisateurs,
            'festivalActif' => $festivalActif,
            'palmares' => $palmares,
            'articles' => $articles,
        ]);
    }
}
