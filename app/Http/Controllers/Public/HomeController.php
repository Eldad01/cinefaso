<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use App\Models\Festival;
use App\Models\Lieu;
use App\Models\Seance;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $seancesDuJour = Seance::query()
            ->whereDate('date_heure', today())
            ->where('active', true)
            ->with(['film', 'lieu'])
            ->orderBy('date_heure')
            ->get();

        $seancesAffiche = $seancesDuJour->unique('film_id')->take(4);

        $lieuxActifs = Lieu::query()
            ->where('active', true)
            ->withCount(['seances' => function ($query) {
                $query->whereDate('date_heure', today())->where('active', true);
            }])
            ->orderByDesc('seances_count')
            ->take(6)
            ->get();

        $prochainEvenement = Evenement::query()
            ->where('date_heure', '>=', now())
            ->with('lieu')
            ->orderBy('date_heure')
            ->first();

        $festivalActif = Festival::where('actif', true)->first();

        return view('public.home', [
            'seancesDuJour' => $seancesDuJour,
            'seancesAffiche' => $seancesAffiche,
            'lieuxActifs' => $lieuxActifs,
            'prochainEvenement' => $prochainEvenement,
            'festivalActif' => $festivalActif,
        ]);
    }
}
