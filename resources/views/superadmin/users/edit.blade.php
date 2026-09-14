@extends('layouts.superadmin')

@section('page-title', 'Modifier le gérant')

@section('content')
    <div class="max-w-lg">
        <div class="rounded-xl border border-cf-line bg-cf-surface p-6">
            <form method="POST" action="{{ route('superadmin.users.update', $user) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="nom" class="block text-sm font-medium text-cf-muted mb-1">Nom</label>
                    <input type="text" name="nom" id="nom" required value="{{ old('nom', $user->nom) }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-cf-muted mb-1">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email', $user->email) }}"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-cf-muted mb-1">Nouveau mot de passe <span class="text-cf-faint">(laisser vide pour ne pas changer)</span></label>
                    <input type="password" name="password" id="password" minlength="8"
                           class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                </div>

                <div>
                    <label for="lieu_id" class="block text-sm font-medium text-cf-muted mb-1">Lieu associé</label>
                    <select name="lieu_id" id="lieu_id" required class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                        @foreach ($lieux as $lieu)
                            <option value="{{ $lieu->id }}" @selected(old('lieu_id', $user->lieu_id) == $lieu->id)>{{ $lieu->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                        Enregistrer
                    </button>
                    <a href="{{ route('superadmin.users.index') }}" class="rounded-lg border border-cf-line px-5 py-2.5 text-sm font-semibold text-cf-muted hover:bg-cf-surface-2 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
