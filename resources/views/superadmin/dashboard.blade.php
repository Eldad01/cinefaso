@extends('layouts.superadmin')

@section('page-title', 'Tableau de bord')

@section('content')
    @if ($festivalActif)
        <div class="mb-6 rounded-xl border-2 border-secondary-400 bg-secondary-50 p-4 flex items-center justify-between gap-4">
            <p class="text-sm text-secondary-800">
                <i class="ti ti-star-filled text-secondary-500 mr-1"></i>
                Festival actif : <strong>{{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}</strong>
            </p>
            <a href="{{ route('superadmin.festivals.programme', $festivalActif) }}" class="text-sm font-semibold text-secondary-700 hover:text-secondary-800">
                Gérer le programme <i class="ti ti-arrow-right"></i>
            </a>
        </div>
    @endif

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Lieux actifs</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $lieuxActifsCount }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Séances publiées</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $seancesCount }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Rappels activés</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $rappelsCount }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Films en base</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $filmsCount }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Vues cumulées</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $vuesTotal }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">Lieux les plus actifs</h2>
            </div>
            @if ($lieuxPlusActifs->isEmpty())
                <p class="p-5 text-gray-500 text-sm">Aucun lieu pour le moment.</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach ($lieuxPlusActifs as $lieu)
                        <li class="px-5 py-3 flex items-center justify-between text-sm">
                            <span class="font-medium text-gray-900">{{ $lieu->nom }}</span>
                            <span class="text-gray-500">{{ $lieu->seances_count }} séances</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <h2 class="font-semibold text-gray-900 mb-4">Accès rapides</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('superadmin.lieux.index') }}" class="rounded-lg border border-gray-200 p-3 text-sm font-medium text-gray-700 hover:border-primary-200 hover:text-primary-700 transition">
                    <i class="ti ti-building block mb-1 text-lg"></i> Lieux
                </a>
                <a href="{{ route('superadmin.films.index') }}" class="rounded-lg border border-gray-200 p-3 text-sm font-medium text-gray-700 hover:border-primary-200 hover:text-primary-700 transition">
                    <i class="ti ti-movie block mb-1 text-lg"></i> Films
                </a>
                <a href="{{ route('superadmin.users.index') }}" class="rounded-lg border border-gray-200 p-3 text-sm font-medium text-gray-700 hover:border-primary-200 hover:text-primary-700 transition">
                    <i class="ti ti-users block mb-1 text-lg"></i> Utilisateurs
                </a>
                <a href="{{ route('superadmin.festivals.index') }}" class="rounded-lg border border-gray-200 p-3 text-sm font-medium text-gray-700 hover:border-primary-200 hover:text-primary-700 transition">
                    <i class="ti ti-star block mb-1 text-lg"></i> Festivals
                </a>
            </div>
        </div>
    </div>
@endsection
