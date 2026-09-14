@extends('layouts.superadmin')

@section('page-title', 'Nouveau lieu')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('superadmin.lieux.store') }}">
                @csrf
                @include('superadmin.lieux._fields')

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="font-semibold text-gray-900 mb-4">Compte gérant associé</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="gerant_nom" class="block text-sm font-medium text-gray-700 mb-1">Nom du gérant</label>
                            <input type="text" name="gerant_nom" id="gerant_nom" required
                                   value="{{ old('gerant_nom') }}"
                                   class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>
                        <div>
                            <label for="gerant_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="gerant_email" id="gerant_email" required
                                   value="{{ old('gerant_email') }}"
                                   class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="gerant_password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <input type="password" name="gerant_password" id="gerant_password" required minlength="8"
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                        Créer le lieu
                    </button>
                    <a href="{{ route('superadmin.lieux.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
