@php
    $article = $article ?? null;
@endphp

@if ($article?->photo)
    <img src="{{ Storage::url($article->photo) }}" alt="{{ $article->titre }}" class="mb-6 h-40 rounded-lg object-cover">
@endif

<div>
    <label for="titre" class="block text-sm font-medium text-cf-muted mb-1">Titre</label>
    <input type="text" name="titre" id="titre" required maxlength="200"
           value="{{ old('titre', $article?->titre) }}"
           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
    <div>
        <label for="type" class="block text-sm font-medium text-cf-muted mb-1">Type</label>
        <select name="type" id="type" required class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
            @foreach (['actualite' => 'Actualité', 'portrait' => 'Portrait', 'palmares' => 'Palmarès'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $article?->type) === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="auteur" class="block text-sm font-medium text-cf-muted mb-1">Auteur</label>
        <input type="text" name="auteur" id="auteur" maxlength="150"
               value="{{ old('auteur', $article?->auteur) }}"
               class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
    </div>
</div>

<div class="mt-4">
    <label for="contenu" class="block text-sm font-medium text-cf-muted mb-1">Contenu</label>
    <textarea name="contenu" id="contenu" rows="8" required
              class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">{{ old('contenu', $article?->contenu) }}</textarea>
</div>

<div class="mt-4">
    <label for="photo" class="block text-sm font-medium text-cf-muted mb-1">Photo <span class="text-cf-faint">(optionnel)</span></label>
    <input type="file" name="photo" id="photo" accept="image/*"
           class="w-full text-sm text-cf-muted file:mr-3 file:rounded-lg file:border-0 file:bg-cf-surface-2 file:px-4 file:py-2 file:text-cf-gold file:font-medium hover:file:bg-cf-surface-2">
</div>

<div class="mt-4 flex items-center gap-2">
    <input type="checkbox" name="publie" id="publie" value="1" @checked(old('publie', $article?->publie))
           class="rounded border-cf-line text-cf-gold focus:ring-cf-gold">
    <label for="publie" class="text-sm text-cf-muted">Publier cet article</label>
</div>
