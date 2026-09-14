<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Rappel;
use App\Models\Seance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RappelController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'seance_id' => ['required', 'integer', 'exists:seances,id'],
            'telephone' => ['required', 'string', 'regex:/^[0-9+\s]{8,20}$/'],
        ]);

        $seance = Seance::findOrFail($validated['seance_id']);

        if (! $seance->active) {
            return back()->withErrors(['telephone' => "Cette séance n'est plus disponible."]);
        }

        $dejaActif = Rappel::where('seance_id', $seance->id)
            ->where('telephone', $validated['telephone'])
            ->exists();

        if ($dejaActif) {
            return back()->with('status', 'rappel-deja-active');
        }

        Rappel::create([
            'seance_id' => $seance->id,
            'telephone' => $validated['telephone'],
            'token' => Str::random(60),
            'notifie' => false,
        ]);

        return back()->with('status', 'rappel-active');
    }
}
