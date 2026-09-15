@extends('layouts.superadmin')

@section('page-title', 'Nouveau gérant')

@section('content')
    <div class="max-w-lg">
        <div class="rounded-xl border border-cf-line bg-cf-surface p-6">
            <form method="POST" action="{{ route('superadmin.users.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="nom" class="block text-sm font-medium text-cf-muted mb-1">Nom</label>
                    <input type="text" name="nom" id="nom" required value="{{ old('nom') }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-cf-muted mb-1">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-cf-muted mb-1">Mot de passe</label>
                    <input type="password" name="password" id="password" required minlength="8"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="lieu_id" class="block text-sm font-medium text-cf-muted mb-1">Cinéma associé</label>
                    <select name="lieu_id" id="lieu_id" required class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                        <option value="">Sélectionner un cinéma</option>
                        @foreach ($lieux as $lieu)
                            <option value="{{ $lieu->id }}" @selected(old('lieu_id') == $lieu->id)>{{ $lieu->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                        Créer le compte
                    </button>
                    <a href="{{ route('superadmin.users.index') }}" class="rounded-lg border border-cf-line px-5 py-2.5 text-sm font-semibold text-cf-muted hover:bg-cf-surface-2 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
