<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FestivalController extends Controller
{
    public function actif(): View
    {
        $festival = Festival::where('actif', true)->first();

        if (! $festival) {
            throw new NotFoundHttpException();
        }

        return $this->render($festival);
    }

    public function show(Festival $festival): View
    {
        return $this->render($festival);
    }

    private function render(Festival $festival): View
    {
        $seancesParCategorie = $festival->seances()
            ->with(['film', 'lieu'])
            ->orderBy('date_heure')
            ->get()
            ->groupBy('categorie');

        $lieuxParticipants = $festival->lieux()->where('active', true)->get();

        $evenements = $festival->evenements()->orderBy('date_heure')->get();

        return view('public.festival', [
            'festival' => $festival,
            'seancesParCategorie' => $seancesParCategorie,
            'lieuxParticipants' => $lieuxParticipants,
            'evenements' => $evenements,
        ]);
    }
}
