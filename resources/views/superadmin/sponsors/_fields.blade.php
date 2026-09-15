@php
    $sponsor = $sponsor ?? null;
@endphp

@if ($sponsor?->logo)
    <div class="mb-6 h-20 w-20 rounded-full bg-white/95 p-3 flex items-center justify-center">
        <img src="{{ Storage::url($sponsor->logo) }}" alt="{{ $sponsor->nom }}" class="max-h-full max-w-full object-contain">
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label for="nom" class="block text-sm font-medium text-cf-muted mb-1">Nom</label>
        <input type="text" name="nom" id="nom" required maxlength="150"
               value="{{ old('nom', $sponsor?->nom) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="site_web" class="block text-sm font-medium text-cf-muted mb-1">Site web <span class="text-cf-faint">(optionnel)</span></label>
        <input type="url" name="site_web" id="site_web" maxlength="250" placeholder="https://…"
               value="{{ old('site_web', $sponsor?->site_web) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
    <div>
        <label for="logo" class="block text-sm font-medium text-cf-muted mb-1">Logo <span class="text-cf-faint">(JPG/PNG/WebP, 1 Mo max)</span></label>
        <input type="file" name="logo" id="logo" accept="image/*"
               class="w-full text-sm text-cf-muted file:mr-3 file:rounded-lg file:border-0 file:bg-cf-surface-2 file:px-4 file:py-2 file:text-cf-gold file:font-medium hover:file:bg-cf-surface-2">
    </div>
    <div>
        <label for="ordre" class="block text-sm font-medium text-cf-muted mb-1">Ordre d'affichage <span class="text-cf-faint">(plus petit = affiché en premier)</span></label>
        <input type="number" name="ordre" id="ordre" min="0"
               value="{{ old('ordre', $sponsor?->ordre ?? 0) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="mt-4 flex items-center gap-2">
    <input type="checkbox" name="actif" id="actif" value="1"
           @checked(old('actif', $sponsor?->actif ?? true))
           class="rounded border-cf-line text-cf-gold focus:ring-cf-gold">
    <label for="actif" class="text-sm text-cf-muted">Visible sur le site</label>
</div>
