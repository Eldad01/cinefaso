@extends('layouts.admin')

@section('page-title', 'Ma salle')

@section('content')
    <div class="max-w-xl">
        <div class="rounded-xl border border-cf-line bg-cf-surface p-6">
            @if ($lieu->photo)
                <img src="{{ Storage::url($lieu->photo) }}" alt="{{ $lieu->nom }}" class="mb-6 h-40 w-full rounded-lg object-cover">
            @endif

            <form method="POST" action="{{ route('admin.lieu.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="nom" class="block text-sm font-medium text-cf-muted mb-1">Nom</label>
                    <input type="text" name="nom" id="nom" required maxlength="150"
                           value="{{ old('nom', $lieu->nom) }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="adresse" class="block text-sm font-medium text-cf-muted mb-1">Adresse</label>
                    <input type="text" name="adresse" id="adresse" required maxlength="250"
                           value="{{ old('adresse', $lieu->adresse) }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="telephone" class="block text-sm font-medium text-cf-muted mb-1">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" maxlength="20"
                           value="{{ old('telephone', $lieu->telephone) }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="horaires" class="block text-sm font-medium text-cf-muted mb-1">Horaires</label>
                    <input type="text" name="horaires" id="horaires" maxlength="200"
                           value="{{ old('horaires', $lieu->horaires) }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="tarifs" class="block text-sm font-medium text-cf-muted mb-1">Tarifs</label>
                    <input type="text" name="tarifs" id="tarifs" maxlength="200"
                           value="{{ old('tarifs', $lieu->tarifs) }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-cf-muted mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">{{ old('description', $lieu->description) }}</textarea>
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-cf-muted mb-1">Photo <span class="text-cf-faint">(JPG/PNG/WebP, 2 Mo max)</span></label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                           class="w-full text-sm text-cf-muted file:mr-3 file:rounded-lg file:border-0 file:bg-cf-surface-2 file:px-4 file:py-2 file:text-cf-gold file:font-medium hover:file:bg-cf-surface-2">
                </div>

                <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                    Enregistrer les modifications
                </button>
            </form>
        </div>
    </div>
@endsection
