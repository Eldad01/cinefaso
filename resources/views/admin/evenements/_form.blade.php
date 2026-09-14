@php
    $evenement = $evenement ?? null;
@endphp

<div class="space-y-5">
    <div>
        <label for="titre" class="block text-sm font-medium text-cf-muted mb-1">Titre</label>
        <input type="text" name="titre" id="titre" required maxlength="200"
               value="{{ old('titre', $evenement?->titre) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>

    <div>
        <label for="type" class="block text-sm font-medium text-cf-muted mb-1">Type</label>
        <select name="type" id="type" required
                class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
            @foreach (['avant_premiere' => 'Avant-première', 'debat' => 'Débat', 'ceremonie' => 'Cérémonie', 'projection_speciale' => 'Projection spéciale', 'autre' => 'Autre'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $evenement?->type) === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="date_heure" class="block text-sm font-medium text-cf-muted mb-1">Date et heure</label>
        <input type="datetime-local" name="date_heure" id="date_heure" required
               value="{{ old('date_heure', $evenement?->date_heure?->format('Y-m-d\TH:i')) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-cf-muted mb-1">Description <span class="text-cf-faint">(optionnel)</span></label>
        <textarea name="description" id="description" rows="4"
                  class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">{{ old('description', $evenement?->description) }}</textarea>
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="est_fespaco" id="est_fespaco" value="1"
               @checked(old('est_fespaco', $evenement?->est_fespaco))
               class="rounded border-cf-line text-cf-gold focus:ring-cf-gold">
        <label for="est_fespaco" class="text-sm text-cf-muted">Cet événement fait partie du FESPACO</label>
    </div>
</div>
