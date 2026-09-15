@php
    $film = $film ?? null;
@endphp

@if ($film?->affiche)
    <img src="{{ Storage::url($film->affiche) }}" alt="{{ $film->titre }}" class="mb-6 h-40 rounded-lg object-cover">
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label for="titre" class="block text-sm font-medium text-cf-muted mb-1">Titre</label>
        <input type="text" name="titre" id="titre" required maxlength="200"
               value="{{ old('titre', $film?->titre) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="titre_original" class="block text-sm font-medium text-cf-muted mb-1">Titre original</label>
        <input type="text" name="titre_original" id="titre_original" maxlength="200"
               value="{{ old('titre_original', $film?->titre_original) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4">
    <div>
        <label for="duree_min" class="block text-sm font-medium text-cf-muted mb-1">Durée (min)</label>
        <input type="number" name="duree_min" id="duree_min" required min="1"
               value="{{ old('duree_min', $film?->duree_min) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="annee" class="block text-sm font-medium text-cf-muted mb-1">Année</label>
        <input type="number" name="annee" id="annee" required min="1900"
               value="{{ old('annee', $film?->annee) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="langue" class="block text-sm font-medium text-cf-muted mb-1">Langue</label>
        <input type="text" name="langue" id="langue" required maxlength="100"
               value="{{ old('langue', $film?->langue) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="genre" class="block text-sm font-medium text-cf-muted mb-1">Genre</label>
        <input type="text" name="genre" id="genre" required maxlength="150"
               value="{{ old('genre', $film?->genre) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
    <div>
        <label for="realisateur" class="block text-sm font-medium text-cf-muted mb-1">Réalisateur</label>
        <input type="text" name="realisateur" id="realisateur" required maxlength="150"
               value="{{ old('realisateur', $film?->realisateur) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
    <div>
        <label for="pays" class="block text-sm font-medium text-cf-muted mb-1">Pays</label>
        <input type="text" name="pays" id="pays" required maxlength="100"
               value="{{ old('pays', $film?->pays) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="mt-4">
    <label for="synopsis" class="block text-sm font-medium text-cf-muted mb-1">Synopsis</label>
    <textarea name="synopsis" id="synopsis" rows="4"
              class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">{{ old('synopsis', $film?->synopsis) }}</textarea>
</div>

<div class="mt-4">
    <label for="prix_fespaco" class="block text-sm font-medium text-cf-muted mb-1">Prix / distinction FESPACO <span class="text-cf-faint">(optionnel)</span></label>
    <input type="text" name="prix_fespaco" id="prix_fespaco" maxlength="250"
           value="{{ old('prix_fespaco', $film?->prix_fespaco) }}"
           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
</div>

<div class="mt-4">
    <label for="affiche" class="block text-sm font-medium text-cf-muted mb-1">Affiche <span class="text-cf-faint">(JPG/PNG/WebP, 2 Mo max)</span></label>
    <input type="file" name="affiche" id="affiche" accept="image/*"
           class="w-full text-sm text-cf-muted file:mr-3 file:rounded-lg file:border-0 file:bg-cf-surface-2 file:px-4 file:py-2 file:text-cf-gold file:font-medium hover:file:bg-cf-surface-2">
</div>

<div class="mt-4">
    <p class="text-sm font-medium text-cf-muted mb-1">Mise en avant <span class="text-cf-faint">(optionnel)</span></p>
    <p class="text-xs text-cf-faint mb-2">
        Le pays du film est déjà défini ci-dessus (Europe, Amérique, Asie…). Cochez seulement si vous voulez
        aussi le mettre en avant dans la rubrique « Découvrir » — un film ne cochant rien reste un film valide.
    </p>
    <div class="flex items-center gap-6">
        <label class="flex items-center gap-2 text-sm text-cf-muted">
            <input type="checkbox" name="est_africain" value="1" @checked(old('est_africain', $film?->est_africain))
                   class="rounded border-cf-line text-cf-gold focus:ring-cf-gold">
            Mettre en avant comme film africain
        </label>
        <label class="flex items-center gap-2 text-sm text-cf-muted">
            <input type="checkbox" name="est_burkinabe" value="1" @checked(old('est_burkinabe', $film?->est_burkinabe))
                   class="rounded border-cf-line text-cf-gold focus:ring-cf-gold">
            Mettre en avant comme film burkinabè
        </label>
    </div>
</div>
