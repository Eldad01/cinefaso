@php
    $article = $article ?? null;
@endphp

@if ($article?->photo)
    <img src="{{ Storage::url($article->photo) }}" alt="{{ $article->titre }}" class="mb-6 h-40 rounded-lg object-cover">
@endif

<div>
    <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
    <input type="text" name="titre" id="titre" required maxlength="200"
           value="{{ old('titre', $article?->titre) }}"
           class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
    <div>
        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
        <select name="type" id="type" required class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
            @foreach (['actualite' => 'Actualité', 'portrait' => 'Portrait', 'palmares' => 'Palmarès'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $article?->type) === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="auteur" class="block text-sm font-medium text-gray-700 mb-1">Auteur</label>
        <input type="text" name="auteur" id="auteur" maxlength="150"
               value="{{ old('auteur', $article?->auteur) }}"
               class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
    </div>
</div>

<div class="mt-4">
    <label for="contenu" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
    <textarea name="contenu" id="contenu" rows="8" required
              class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">{{ old('contenu', $article?->contenu) }}</textarea>
</div>

<div class="mt-4">
    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Photo <span class="text-gray-400">(optionnel)</span></label>
    <input type="file" name="photo" id="photo" accept="image/*"
           class="w-full text-sm text-gray-600 file:mr-3 file:rounded-lg file:border-0 file:bg-primary-50 file:px-4 file:py-2 file:text-primary-700 file:font-medium hover:file:bg-primary-100">
</div>

<div class="mt-4 flex items-center gap-2">
    <input type="checkbox" name="publie" id="publie" value="1" @checked(old('publie', $article?->publie))
           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
    <label for="publie" class="text-sm text-gray-700">Publier cet article</label>
</div>
