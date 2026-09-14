<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\View\View;

class EvenementController extends Controller
{
    public function show(Evenement $evenement): View
    {
        $evenement->load(['lieu', 'festival']);

        $autresEvenements = Evenement::query()
            ->where('id', '!=', $evenement->id)
            ->where('date_heure', '>=', now())
            ->orderBy('date_heure')
            ->with('lieu')
            ->take(3)
            ->get();

        return view('public.evenement', [
            'evenement' => $evenement,
            'autresEvenements' => $autresEvenements,
        ]);
    }
}
