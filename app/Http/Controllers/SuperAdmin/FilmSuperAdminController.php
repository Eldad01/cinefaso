<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilmRequest;
use App\Models\Film;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilmSuperAdminController extends Controller
{
    public function index(Request $request): View
    {
        $films = Film::query()
            ->when($request->filled('q'), fn ($q) => $q->where('titre', 'like', '%'.$request->string('q').'%'))
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('superadmin.films.index', compact('films'));
    }

    public function create(): View
    {
        return view('superadmin.films.create');
    }

    public function store(StoreFilmRequest $request): RedirectResponse
    {
        $validated = $this->prepare($request);

        Film::create($validated);

        return redirect()->route('superadmin.films.index')->with('status', 'film-cree');
    }

    public function edit(Film $film): View
    {
        return view('superadmin.films.edit', compact('film'));
    }

    public function update(StoreFilmRequest $request, Film $film): RedirectResponse
    {
        $validated = $this->prepare($request);

        $film->update($validated);

        return redirect()->route('superadmin.films.index')->with('status', 'film-modifie');
    }

    public function destroy(Film $film): RedirectResponse
    {
        if ($film->seances()->where('date_heure', '>=', now())->exists()) {
            return back()->withErrors(['film' => 'Impossible de supprimer : des séances à venir utilisent ce film.']);
        }

        $film->delete();

        return redirect()->route('superadmin.films.index')->with('status', 'film-supprime');
    }

    private function prepare(StoreFilmRequest $request): array
    {
        $validated = $request->validated();

        $validated['est_africain'] = $request->boolean('est_africain');
        $validated['est_burkinabe'] = $request->boolean('est_burkinabe');
        unset($validated['affiche']);

        if ($request->hasFile('affiche')) {
            $validated['affiche'] = $request->file('affiche')->store('affiches', 'public');
        }

        return $validated;
    }
}
