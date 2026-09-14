@php
    $evenement = $evenement ?? null;
@endphp

<div class="space-y-5">
    <div>
        <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
        <input type="text" name="titre" id="titre" required maxlength="200"
               value="{{ old('titre', $evenement?->titre) }}"
               class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
    </div>

    <div>
        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
        <select name="type" id="type" required
                class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
            @foreach (['avant_premiere' => 'Avant-première', 'debat' => 'Débat', 'ceremonie' => 'Cérémonie', 'projection_speciale' => 'Projection spéciale', 'autre' => 'Autre'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $evenement?->type) === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="date_heure" class="block text-sm font-medium text-gray-700 mb-1">Date et heure</label>
        <input type="datetime-local" name="date_heure" id="date_heure" required
               value="{{ old('date_heure', $evenement?->date_heure?->format('Y-m-d\TH:i')) }}"
               class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-gray-400">(optionnel)</span></label>
        <textarea name="description" id="description" rows="4"
                  class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">{{ old('description', $evenement?->description) }}</textarea>
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="est_fespaco" id="est_fespaco" value="1"
               @checked(old('est_fespaco', $evenement?->est_fespaco))
               class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
        <label for="est_fespaco" class="text-sm text-gray-700">Cet événement fait partie du FESPACO</label>
    </div>
</div>
