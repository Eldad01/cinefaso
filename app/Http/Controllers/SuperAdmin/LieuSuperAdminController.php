<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLieuRequest;
use App\Models\Festival;
use App\Models\Lieu;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LieuSuperAdminController extends Controller
{
    public function index(): View
    {
        $lieux = Lieu::withCount('seances')->orderBy('nom')->paginate(15);

        return view('superadmin.lieux.index', compact('lieux'));
    }

    public function create(): View
    {
        $festivals = Festival::orderByDesc('date_debut')->get();

        return view('superadmin.lieux.create', compact('festivals'));
    }

    public function store(StoreLieuRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $gerant = $request->validate([
            'gerant_nom' => ['required', 'string', 'max:100'],
            'gerant_email' => ['required', 'email', 'unique:users,email'],
            'gerant_password' => ['required', 'string', 'min:8'],
        ]);

        $lieu = Lieu::create([
            ...$validated,
            'ville' => $validated['ville'] ?? 'Ouagadougou',
            'partenaire' => $request->boolean('partenaire'),
            'active' => true,
        ]);

        User::create([
            'name' => $gerant['gerant_nom'],
            'nom' => $gerant['gerant_nom'],
            'email' => $gerant['gerant_email'],
            'password' => Hash::make($gerant['gerant_password']),
            'role' => 'gerant',
            'lieu_id' => $lieu->id,
            'active' => true,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('superadmin.lieux.index')->with('status', 'lieu-cree');
    }

    public function edit(Lieu $lieu): View
    {
        $festivals = Festival::orderByDesc('date_debut')->get();

        return view('superadmin.lieux.edit', compact('lieu', 'festivals'));
    }

    public function update(StoreLieuRequest $request, Lieu $lieu): RedirectResponse
    {
        $validated = $request->validated();
        $validated['partenaire'] = $request->boolean('partenaire');

        $lieu->update($validated);

        return redirect()->route('superadmin.lieux.index')->with('status', 'lieu-modifie');
    }

    public function destroy(Lieu $lieu): RedirectResponse
    {
        $lieu->update(['active' => false]);

        return redirect()->route('superadmin.lieux.index')->with('status', 'lieu-archive');
    }

    public function toggle(Lieu $lieu): RedirectResponse
    {
        $lieu->update(['active' => ! $lieu->active]);

        return back()->with('status', $lieu->active ? 'lieu-active' : 'lieu-desactive');
    }
}
