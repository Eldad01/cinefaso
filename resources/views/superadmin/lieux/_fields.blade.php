@php
    $lieu = $lieu ?? null;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label for="nom" class="block text-sm font-medium text-cf-muted mb-1">Nom</label>
        <input type="text" name="nom" id="nom" required maxlength="150"
               value="{{ old('nom', $lieu?->nom) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="type" class="block text-sm font-medium text-cf-muted mb-1">Type</label>
        <select name="type" id="type" required class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
            <option value="salle_permanente" @selected(old('type', $lieu?->type ?? 'salle_permanente') === 'salle_permanente')>Salle permanente</option>
            <option value="lieu_temporaire" @selected(old('type', $lieu?->type) === 'lieu_temporaire')>Site temporaire</option>
        </select>
    </div>
</div>

<div class="mt-4">
    <label for="adresse" class="block text-sm font-medium text-cf-muted mb-1">Adresse</label>
    <input type="text" name="adresse" id="adresse" required maxlength="250"
           value="{{ old('adresse', $lieu?->adresse) }}"
           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
    <div>
        <label for="ville" class="block text-sm font-medium text-cf-muted mb-1">Ville</label>
        <input type="text" name="ville" id="ville" maxlength="100"
               value="{{ old('ville', $lieu?->ville ?? 'Ouagadougou') }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="telephone" class="block text-sm font-medium text-cf-muted mb-1">Téléphone</label>
        <input type="text" name="telephone" id="telephone" maxlength="20"
               value="{{ old('telephone', $lieu?->telephone) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
    <div>
        <label for="horaires" class="block text-sm font-medium text-cf-muted mb-1">Horaires</label>
        <input type="text" name="horaires" id="horaires" maxlength="200"
               value="{{ old('horaires', $lieu?->horaires) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="tarifs" class="block text-sm font-medium text-cf-muted mb-1">Tarifs</label>
        <input type="text" name="tarifs" id="tarifs" maxlength="200"
               value="{{ old('tarifs', $lieu?->tarifs) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
    <div>
        <label for="latitude" class="block text-sm font-medium text-cf-muted mb-1">Latitude</label>
        <input type="number" step="any" name="latitude" id="latitude"
               value="{{ old('latitude', $lieu?->latitude) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="longitude" class="block text-sm font-medium text-cf-muted mb-1">Longitude</label>
        <input type="number" step="any" name="longitude" id="longitude"
               value="{{ old('longitude', $lieu?->longitude) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="mt-4">
    <label for="description" class="block text-sm font-medium text-cf-muted mb-1">Description</label>
    <textarea name="description" id="description" rows="3"
              class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">{{ old('description', $lieu?->description) }}</textarea>
</div>

<div class="mt-4">
    <label for="festival_id" class="block text-sm font-medium text-cf-muted mb-1">Festival associé <span class="text-cf-faint">(pour un site temporaire)</span></label>
    <select name="festival_id" id="festival_id" class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
        <option value="">Aucun</option>
        @foreach ($festivals as $festival)
            <option value="{{ $festival->id }}" @selected(old('festival_id', $lieu?->festival_id) == $festival->id)>
                {{ $festival->nom }}{{ $festival->edition ? ' — '.$festival->edition : '' }}
            </option>
        @endforeach
    </select>
</div>

<div class="mt-4 flex items-center gap-2">
    <input type="checkbox" name="partenaire" id="partenaire" value="1"
           @checked(old('partenaire', $lieu?->partenaire ?? true))
           class="rounded border-cf-line text-cf-gold focus:ring-cf-gold">
    <label for="partenaire" class="text-sm text-cf-muted">Cinéma partenaire</label>
</div>
