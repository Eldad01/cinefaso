<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFestivalRequest;
use App\Models\Festival;
use App\Models\Film;
use App\Models\Lieu;
use App\Models\Seance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FestivalSuperAdminController extends Controller
{
    public function index(): View
    {
        $festivals = Festival::orderByDesc('date_debut')->paginate(15);

        return view('superadmin.festivals.index', compact('festivals'));
    }

    public function create(): View
    {
        return view('superadmin.festivals.create');
    }

    public function store(StoreFestivalRequest $request): RedirectResponse
    {
        Festival::create($request->validated());

        return redirect()->route('superadmin.festivals.index')->with('status', 'festival-cree');
    }

    public function edit(Festival $festival): View
    {
        return view('superadmin.festivals.edit', compact('festival'));
    }

    public function update(StoreFestivalRequest $request, Festival $festival): RedirectResponse
    {
        $festival->update($request->validated());

        return redirect()->route('superadmin.festivals.index')->with('status', 'festival-modifie');
    }

    public function activer(Festival $festival): RedirectResponse
    {
        Festival::where('actif', true)->update(['actif' => false]);
        $festival->update(['actif' => true]);

        return back()->with('status', 'festival-active');
    }

    public function clore(Festival $festival): RedirectResponse
    {
        $festival->update(['actif' => false]);

        return back()->with('status', 'festival-clos');
    }

    public function programme(Festival $festival): View
    {
        $lieuxParticipants = Lieu::query()
            ->where('active', true)
            ->where(function ($q) use ($festival) {
                $q->where('type', 'salle_permanente')->orWhere('festival_id', $festival->id);
            })
            ->orderBy('nom')
            ->get();

        $films = Film::orderBy('titre')->get();

        $seances = $festival->seances()->with(['film', 'lieu'])->orderBy('date_heure')->get();

        return view('superadmin.festivals.programme', compact('festival', 'lieuxParticipants', 'films', 'seances'));
    }

    public function programmeStore(Request $request, Festival $festival): RedirectResponse
    {
        $validated = $request->validate([
            'lignes' => ['required', 'array'],
            'lignes.*.lieu_id' => ['required', 'exists:lieux,id'],
            'lignes.*.film_id' => ['required', 'exists:films,id'],
            'lignes.*.categorie' => ['required', 'in:normale,competition,hors_competition,panorama'],
            'lignes.*.date_heure' => ['required', 'date'],
            'lignes.*.tarif_fcfa' => ['required', 'integer', 'min:0'],
            'lignes.*.version' => ['required', 'in:VF,VO,VOSTFR,3D,3D-VF,3D-VOSTFR'],
        ]);

        foreach ($validated['lignes'] as $ligne) {
            Seance::create([
                'lieu_id' => $ligne['lieu_id'],
                'film_id' => $ligne['film_id'],
                'festival_id' => $festival->id,
                'date_heure' => $ligne['date_heure'],
                'tarif_fcfa' => $ligne['tarif_fcfa'],
                'version' => $ligne['version'],
                'categorie' => $ligne['categorie'],
                'active' => true,
            ]);
        }

        return redirect()->route('superadmin.festivals.programme', $festival)->with('status', 'programme-publie');
    }
}
