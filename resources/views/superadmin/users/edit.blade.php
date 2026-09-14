@extends('layouts.superadmin')

@section('page-title', 'Modifier le gérant')

@section('content')
    <div class="max-w-lg">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('superadmin.users.update', $user) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                    <input type="text" name="nom" id="nom" required value="{{ old('nom', $user->nom) }}"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email', $user->email) }}"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe <span class="text-gray-400">(laisser vide pour ne pas changer)</span></label>
                    <input type="password" name="password" id="password" minlength="8"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                </div>

                <div>
                    <label for="lieu_id" class="block text-sm font-medium text-gray-700 mb-1">Lieu associé</label>
                    <select name="lieu_id" id="lieu_id" required class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        @foreach ($lieux as $lieu)
                            <option value="{{ $lieu->id }}" @selected(old('lieu_id', $user->lieu_id) == $lieu->id)>{{ $lieu->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                        Enregistrer
                    </button>
                    <a href="{{ route('superadmin.users.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
