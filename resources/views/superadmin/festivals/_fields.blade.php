@php
    $festival = $festival ?? null;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label for="nom" class="block text-sm font-medium text-cf-muted mb-1">Nom</label>
        <input type="text" name="nom" id="nom" required maxlength="200"
               value="{{ old('nom', $festival?->nom) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="edition" class="block text-sm font-medium text-cf-muted mb-1">Édition</label>
        <input type="text" name="edition" id="edition" maxlength="100"
               value="{{ old('edition', $festival?->edition) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
    <div>
        <label for="date_debut" class="block text-sm font-medium text-cf-muted mb-1">Date de début</label>
        <input type="date" name="date_debut" id="date_debut" required
               value="{{ old('date_debut', $festival?->date_debut?->format('Y-m-d')) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="date_fin" class="block text-sm font-medium text-cf-muted mb-1">Date de fin</label>
        <input type="date" name="date_fin" id="date_fin" required
               value="{{ old('date_fin', $festival?->date_fin?->format('Y-m-d')) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="mt-4">
    <label for="site_web" class="block text-sm font-medium text-cf-muted mb-1">Site web</label>
    <input type="text" name="site_web" id="site_web" maxlength="250"
           value="{{ old('site_web', $festival?->site_web) }}"
           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
</div>

<div class="mt-4">
    <label for="description" class="block text-sm font-medium text-cf-muted mb-1">Description</label>
    <textarea name="description" id="description" rows="3"
              class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">{{ old('description', $festival?->description) }}</textarea>
</div>

<div class="mt-4">
    <label for="palmares" class="block text-sm font-medium text-cf-muted mb-1">Palmarès <span class="text-cf-faint">(affiché sur la page Découvrir)</span></label>
    <textarea name="palmares" id="palmares" rows="3"
              class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">{{ old('palmares', $festival?->palmares) }}</textarea>
</div>
