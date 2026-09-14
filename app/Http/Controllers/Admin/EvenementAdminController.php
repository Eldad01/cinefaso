<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EvenementAdminController extends Controller
{
    public function index(): View
    {
        $evenements = Auth::user()->lieu->evenements()
            ->orderByDesc('date_heure')
            ->paginate(15);

        return view('admin.evenements.index', compact('evenements'));
    }

    public function create(): View
    {
        return view('admin.evenements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $validated['lieu_id'] = Auth::user()->lieu_id;

        Evenement::create($validated);

        return redirect()->route('admin.evenements.index')->with('status', 'evenement-cree');
    }

    public function edit(Evenement $evenement): View
    {
        $this->authorizeOwnership($evenement);

        return view('admin.evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement): RedirectResponse
    {
        $this->authorizeOwnership($evenement);

        $evenement->update($this->validated($request));

        return redirect()->route('admin.evenements.index')->with('status', 'evenement-modifie');
    }

    public function destroy(Evenement $evenement): RedirectResponse
    {
        $this->authorizeOwnership($evenement);

        $evenement->delete();

        return redirect()->route('admin.evenements.index')->with('status', 'evenement-supprime');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'titre' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:avant_premiere,debat,ceremonie,projection_speciale,autre'],
            'date_heure' => ['required', 'date'],
            'est_fespaco' => ['sometimes', 'boolean'],
        ]);
    }

    private function authorizeOwnership(Evenement $evenement): void
    {
        abort_unless($evenement->lieu_id === Auth::user()->lieu_id, 403);
    }
}
