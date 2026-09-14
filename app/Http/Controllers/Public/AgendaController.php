<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(Request $request): View
    {
        $evenements = Evenement::query()
            ->where('date_heure', '>=', now())
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->string('type')))
            ->with('lieu')
            ->orderBy('date_heure')
            ->get()
            ->groupBy(fn (Evenement $e) => $e->date_heure->locale('fr')->translatedFormat('F Y'));

        $prochains = Evenement::query()
            ->where('date_heure', '>=', now())
            ->orderBy('date_heure')
            ->take(5)
            ->get();

        return view('public.agenda', [
            'evenements' => $evenements,
            'prochains' => $prochains,
        ]);
    }
}
