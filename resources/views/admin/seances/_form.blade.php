@php
    $seance = $seance ?? null;
@endphp

<div class="space-y-5">
    <div>
        <label for="film_id" class="block text-sm font-medium text-cf-muted mb-1">Film</label>
        <select name="film_id" id="film_id" required
                class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
            <option value="">Sélectionner un film</option>
            @foreach ($films as $film)
                <option value="{{ $film->id }}" @selected(old('film_id', $seance?->film_id) == $film->id)>
                    {{ $film->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="date_heure" class="block text-sm font-medium text-cf-muted mb-1">Date et heure</label>
        <input type="datetime-local" name="date_heure" id="date_heure" required
               value="{{ old('date_heure', $seance?->date_heure?->format('Y-m-d\TH:i')) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="tarif_fcfa" class="block text-sm font-medium text-cf-muted mb-1">Tarif (FCFA)</label>
            <input type="number" name="tarif_fcfa" id="tarif_fcfa" min="0" required
                   value="{{ old('tarif_fcfa', $seance?->tarif_fcfa) }}"
                   class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
        </div>
        <div>
            <label for="version" class="block text-sm font-medium text-cf-muted mb-1">Version</label>
            <select name="version" id="version" required
                    class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                @foreach (['VF', 'VO', 'VOSTFR', '3D', '3D-VF', '3D-VOSTFR'] as $version)
                    <option value="{{ $version }}" @selected(old('version', $seance?->version) === $version)>{{ $version }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="age_minimum" class="block text-sm font-medium text-cf-muted mb-1">Âge minimum <span class="text-cf-faint">(optionnel)</span></label>
            <input type="number" name="age_minimum" id="age_minimum" min="0"
                   value="{{ old('age_minimum', $seance?->age_minimum) }}"
                   class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
        </div>
        <div>
            <label for="categorie" class="block text-sm font-medium text-cf-muted mb-1">Catégorie</label>
            <select name="categorie" id="categorie"
                    class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                @foreach (['normale' => 'Normale', 'competition' => 'Compétition', 'hors_competition' => 'Hors compétition', 'panorama' => 'Panorama'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('categorie', $seance?->categorie ?? 'normale') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
