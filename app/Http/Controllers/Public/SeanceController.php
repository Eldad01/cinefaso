<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Lieu;
use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeanceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Seance::query()
            ->whereDate('date_heure', today())
            ->where('active', true)
            ->with(['film', 'lieu']);

        if ($request->filled('lieu')) {
            $query->where('lieu_id', $request->integer('lieu'));
        }

        if ($request->filled('genre')) {
            $genre = $request->string('genre')->toString();
            $query->whereHas('film', fn ($q) => $q->where('genre', $genre));
        }

        if ($request->filled('version')) {
            $query->where('version', $request->string('version')->toString());
        }

        if ($request->boolean('fespaco')) {
            $query->whereNotNull('festival_id');
        }

        $seances = $query->orderBy('date_heure')->get();

        $seancesDuJour = Seance::query()
            ->whereDate('date_heure', today())
            ->where('active', true)
            ->with('film')
            ->get();

        $lieuxDuSoir = Lieu::query()
            ->where('active', true)
            ->whereHas('seances', fn ($q) => $q->whereDate('date_heure', today())->where('active', true))
            ->withCount(['seances' => fn ($q) => $q->whereDate('date_heure', today())->where('active', true)])
            ->orderBy('nom')
            ->get();

        $genresDisponibles = $seancesDuJour->pluck('film.genre')->filter()->unique()->sort()->values();
        $versionsDisponibles = $seancesDuJour->pluck('version')->filter()->unique()->values();

        return view('public.ce-soir', [
            'seances' => $seances,
            'lieuxDuSoir' => $lieuxDuSoir,
            'genresDisponibles' => $genresDisponibles,
            'versionsDisponibles' => $versionsDisponibles,
        ]);
    }

    public function show(Film $film): View
    {
        $film->increment('vues');

        $seances = Seance::query()
            ->where('film_id', $film->id)
            ->where('date_heure', '>=', now())
            ->where('active', true)
            ->with('lieu')
            ->orderBy('date_heure')
            ->get();

        return view('public.film', [
            'film' => $film,
            'seances' => $seances,
        ]);
    }
}
