<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use App\Models\Lieu;
use Illuminate\View\View;

class LieuController extends Controller
{
    public function index(): View
    {
        $festivalActif = Festival::where('actif', true)->first();

        $lieux = Lieu::query()
            ->where('active', true)
            ->where(function ($query) use ($festivalActif) {
                $query->where('type', 'salle_permanente');

                if ($festivalActif) {
                    $query->orWhere(function ($sub) use ($festivalActif) {
                        $sub->where('type', 'lieu_temporaire')->where('festival_id', $festivalActif->id);
                    });
                }
            })
            ->withCount(['seances' => fn ($q) => $q->whereDate('date_heure', today())->where('active', true)])
            ->orderBy('nom')
            ->get();

        $lieux->each(function (Lieu $lieu): void {
            $lieu->films_du_soir_count = $lieu->seances()
                ->whereDate('date_heure', today())
                ->where('active', true)
                ->pluck('film_id')
                ->unique()
                ->count();
        });

        return view('public.lieux', [
            'lieux' => $lieux,
        ]);
    }

    public function show(Lieu $lieu): View
    {
        $seancesDuSoir = $lieu->seances()
            ->whereDate('date_heure', today())
            ->where('active', true)
            ->with('film')
            ->orderBy('date_heure')
            ->get();

        $prochainsEvenements = $lieu->evenements()
            ->where('date_heure', '>=', now())
            ->orderBy('date_heure')
            ->take(5)
            ->get();

        return view('public.lieu', [
            'lieu' => $lieu,
            'seancesDuSoir' => $seancesDuSoir,
            'prochainsEvenements' => $prochainsEvenements,
        ]);
    }
}
