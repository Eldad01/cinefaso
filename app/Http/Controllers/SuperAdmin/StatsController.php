<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use App\Models\Film;
use App\Models\Lieu;
use App\Models\Rappel;
use App\Models\Seance;
use Illuminate\View\View;

class StatsController extends Controller
{
    public function index(): View
    {
        $lieuxActifsCount = Lieu::where('active', true)->count();
        $seancesCount = Seance::where('active', true)->count();
        $rappelsCount = Rappel::count();
        $filmsCount = Film::count();
        $vuesTotal = Film::sum('vues');

        $lieuxPlusActifs = Lieu::withCount('seances')
            ->orderByDesc('seances_count')
            ->take(5)
            ->get();

        $festivalActif = Festival::where('actif', true)->first();

        return view('superadmin.dashboard', [
            'lieuxActifsCount' => $lieuxActifsCount,
            'seancesCount' => $seancesCount,
            'rappelsCount' => $rappelsCount,
            'filmsCount' => $filmsCount,
            'vuesTotal' => $vuesTotal,
            'lieuxPlusActifs' => $lieuxPlusActifs,
            'festivalActif' => $festivalActif,
        ]);
    }
}
