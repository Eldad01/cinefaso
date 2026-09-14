<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rappel;
use App\Models\Seance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RappelApiController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'seance_id' => ['required', 'integer', 'exists:seances,id'],
            'telephone' => ['required', 'string', 'regex:/^[0-9+\s]{8,20}$/'],
        ]);

        $seance = Seance::findOrFail($validated['seance_id']);

        if (! $seance->active) {
            return response()->json(['message' => "Cette séance n'est plus disponible."], 422);
        }

        $dejaActif = Rappel::where('seance_id', $seance->id)
            ->where('telephone', $validated['telephone'])
            ->exists();

        if ($dejaActif) {
            return response()->json(['message' => 'Un rappel est déjà actif pour cette séance.']);
        }

        Rappel::create([
            'seance_id' => $seance->id,
            'telephone' => $validated['telephone'],
            'token' => Str::random(60),
            'notifie' => false,
        ]);

        return response()->json(['message' => 'Rappel activé avec succès.'], 201);
    }
}
