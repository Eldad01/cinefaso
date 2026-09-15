<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSponsorRequest;
use App\Models\Sponsor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SponsorController extends Controller
{
    public function index(): View
    {
        $sponsors = Sponsor::orderBy('ordre')->orderBy('nom')->paginate(15);

        return view('superadmin.sponsors.index', compact('sponsors'));
    }

    public function create(): View
    {
        return view('superadmin.sponsors.create');
    }

    public function store(StoreSponsorRequest $request): RedirectResponse
    {
        $validated = $this->prepare($request);

        Sponsor::create($validated);

        return redirect()->route('superadmin.sponsors.index')->with('status', 'sponsor-cree');
    }

    public function edit(Sponsor $sponsor): View
    {
        return view('superadmin.sponsors.edit', compact('sponsor'));
    }

    public function update(StoreSponsorRequest $request, Sponsor $sponsor): RedirectResponse
    {
        $validated = $this->prepare($request);

        $sponsor->update($validated);

        return redirect()->route('superadmin.sponsors.index')->with('status', 'sponsor-modifie');
    }

    public function destroy(Sponsor $sponsor): RedirectResponse
    {
        $sponsor->delete();

        return redirect()->route('superadmin.sponsors.index')->with('status', 'sponsor-supprime');
    }

    public function toggle(Sponsor $sponsor): RedirectResponse
    {
        $sponsor->update(['actif' => ! $sponsor->actif]);

        return back()->with('status', $sponsor->actif ? 'sponsor-active' : 'sponsor-desactive');
    }

    private function prepare(StoreSponsorRequest $request): array
    {
        $validated = $request->validated();

        $validated['actif'] = $request->boolean('actif');
        $validated['ordre'] = $validated['ordre'] ?? 0;
        unset($validated['logo']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('sponsors', 'public');
        }

        return $validated;
    }
}
