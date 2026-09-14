<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Rappel;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $lieu = Auth::user()->lieu;

        $seancesCetteSemaine = $lieu->seances()
            ->whereBetween('date_heure', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $filmsDifferents = $lieu->seances()->distinct()->count('film_id');

        $rappelsActifs = Rappel::whereHas('seance', fn ($q) => $q->where('lieu_id', $lieu->id))->count();

        $prochainesSeances = $lieu->seances()
            ->with('film')
            ->where('date_heure', '>=', now())
            ->orderBy('date_heure')
            ->take(10)
            ->get();

        $vuesFilmsAffiche = Film::whereIn('id', $lieu->seances()->where('date_heure', '>=', now())->pluck('film_id'))
            ->sum('vues');

        return view('admin.dashboard', [
            'lieu' => $lieu,
            'seancesCetteSemaine' => $seancesCetteSemaine,
            'filmsDifferents' => $filmsDifferents,
            'rappelsActifs' => $rappelsActifs,
            'prochainesSeances' => $prochainesSeances,
            'vuesFilmsAffiche' => $vuesFilmsAffiche,
        ]);
    }
}
