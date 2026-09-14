<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeanceRequest;
use App\Jobs\AlerterAnnulationSMS;
use App\Models\Film;
use App\Models\Seance;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SeanceAdminController extends Controller
{
    public function index(): View
    {
        $seances = Auth::user()->lieu->seances()
            ->with('film')
            ->orderByDesc('date_heure')
            ->paginate(15);

        return view('admin.seances.index', compact('seances'));
    }

    public function create(): View
    {
        $films = Film::orderBy('titre')->get();

        return view('admin.seances.create', compact('films'));
    }

    public function store(StoreSeanceRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['lieu_id'] = Auth::user()->lieu_id;
        $validated['active'] = true;

        Seance::create($validated);

        return redirect()->route('admin.dashboard')->with('status', 'seance-creee');
    }

    public function edit(Seance $seance): View
    {
        $this->authorizeOwnership($seance);

        $films = Film::orderBy('titre')->get();

        return view('admin.seances.edit', compact('seance', 'films'));
    }

    public function update(StoreSeanceRequest $request, Seance $seance, SmsService $sms): RedirectResponse
    {
        $this->authorizeOwnership($seance);

        $ancienneDateHeure = $seance->date_heure;

        $seance->update($request->validated());

        if (! $ancienneDateHeure->equalTo($seance->date_heure)) {
            $seance->loadMissing(['film', 'lieu']);

            $message = sprintf(
                'CinéFaso — Changement d\'horaire : %s au %s est maintenant à %s.',
                $seance->film->titre,
                $seance->lieu->nom,
                $seance->date_heure->format('H:i')
            );

            $seance->rappels()->where('notifie', false)->get()->each(
                fn ($rappel) => $sms->send($rappel->telephone, $message)
            );
        }

        return redirect()->route('admin.seances.index')->with('status', 'seance-modifiee');
    }

    public function destroy(Seance $seance): RedirectResponse
    {
        $this->authorizeOwnership($seance);

        $seance->update(['active' => false]);

        AlerterAnnulationSMS::dispatch($seance);

        return redirect()->route('admin.seances.index')->with('status', 'seance-annulee');
    }

    public function grille(): View
    {
        $films = Film::orderBy('titre')->get();

        return view('admin.seances.grille', compact('films'));
    }

    public function grilleStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'semaine_du' => ['required', 'date'],
            'lignes' => ['required', 'array'],
            'lignes.*.film_id' => ['required', 'exists:films,id'],
            'lignes.*.version' => ['required', 'in:VF,VO,VOSTFR,3D,3D-VF,3D-VOSTFR'],
            'lignes.*.tarif_fcfa' => ['required', 'integer', 'min:0'],
            'lignes.*.horaires' => ['required', 'array', 'size:7'],
        ]);

        $lieuId = Auth::user()->lieu_id;
        $debut = Carbon::parse($validated['semaine_du'])->startOfDay();
        $count = 0;

        foreach ($validated['lignes'] as $ligne) {
            foreach ($ligne['horaires'] as $jourIndex => $heure) {
                if (empty($heure)) {
                    continue;
                }

                [$h, $m] = array_pad(explode(':', $heure), 2, 0);

                Seance::create([
                    'lieu_id' => $lieuId,
                    'film_id' => $ligne['film_id'],
                    'date_heure' => $debut->copy()->addDays((int) $jourIndex)->setTime((int) $h, (int) $m),
                    'tarif_fcfa' => $ligne['tarif_fcfa'],
                    'version' => $ligne['version'],
                    'active' => true,
                ]);

                $count++;
            }
        }

        return redirect()->route('admin.dashboard')->with('status', "grille-publiee:{$count}");
    }

    private function authorizeOwnership(Seance $seance): void
    {
        abort_unless($seance->lieu_id === Auth::user()->lieu_id, 403);
    }
}
