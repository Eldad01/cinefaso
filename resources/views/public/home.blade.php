@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-14">

    {{-- Hero --}}
    <section class="rounded-2xl bg-gradient-to-br from-primary-700 to-primary-900 text-white px-6 py-12 sm:px-12 sm:py-16 text-center">
        <p class="text-secondary-300 font-semibold uppercase tracking-wide text-sm">
            {{ now()->locale('fr')->translatedFormat('l d F Y') }}
        </p>
        <h1 class="mt-3 text-3xl sm:text-5xl font-extrabold">Ce soir à Ouagadougou</h1>
        <p class="mt-4 text-lg text-white/90">
            {{ $seancesDuJour->count() }} séance{{ $seancesDuJour->count() > 1 ? 's' : '' }}
            au programme dans {{ $lieuxActifs->where('seances_count', '>', 0)->count() }} lieux
        </p>
        <a href="{{ Route::has('ce-soir') ? route('ce-soir') : '#' }}"
           class="mt-8 inline-flex items-center gap-2 rounded-lg bg-white text-primary-700 font-semibold px-6 py-3 hover:bg-secondary-50 transition">
            Voir le programme complet <i class="ti ti-arrow-right"></i>
        </a>
    </section>

    {{-- Festival actif --}}
    @if ($festivalActif)
        <section class="rounded-2xl border-2 border-secondary-400 bg-secondary-50 p-6 sm:p-8 flex flex-col sm:flex-row items-center gap-6">
            <i class="ti ti-star-filled text-5xl text-secondary-500 shrink-0"></i>
            <div class="flex-1 text-center sm:text-left">
                <p class="text-secondary-700 font-semibold uppercase text-xs tracking-wide">Festival en cours</p>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}
                </h2>
                <p class="text-gray-600 mt-1">
                    du {{ $festivalActif->date_debut->locale('fr')->translatedFormat('d F') }}
                    au {{ $festivalActif->date_fin->locale('fr')->translatedFormat('d F Y') }}
                </p>
            </div>
            <a href="{{ Route::has('festival.actif') ? route('festival.actif') : '#' }}"
               class="shrink-0 inline-flex items-center gap-2 rounded-lg bg-secondary-500 text-white font-semibold px-5 py-2.5 hover:bg-secondary-600 transition">
                Découvrir <i class="ti ti-arrow-right"></i>
            </a>
        </section>
    @endif

    {{-- Films à l'affiche --}}
    <section>
        <x-section-title title="Films à l'affiche ce soir" subtitle="Une sélection des séances du jour">
            <x-slot name="actions">
                <a href="{{ Route::has('ce-soir') ? route('ce-soir') : '#' }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">
                    Voir tout <i class="ti ti-arrow-right"></i>
                </a>
            </x-slot>
        </x-section-title>

        @if ($seancesAffiche->isEmpty())
            <p class="text-gray-500">Aucune séance programmée aujourd'hui pour le moment.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($seancesAffiche as $seance)
                    <x-card-film :seance="$seance" />
                @endforeach
            </div>
        @endif
    </section>

    {{-- Les lieux --}}
    <section>
        <x-section-title title="Les salles" subtitle="Cinémas et lieux partenaires à Ouagadougou">
            <x-slot name="actions">
                <a href="{{ Route::has('lieux.index') ? route('lieux.index') : '#' }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">
                    Tous les lieux <i class="ti ti-arrow-right"></i>
                </a>
            </x-slot>
        </x-section-title>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($lieuxActifs as $lieu)
                <x-card-lieu :lieu="$lieu" :ouvert-ce-soir="$lieu->seances_count > 0" />
            @endforeach
        </div>
    </section>

    {{-- Prochain événement --}}
    @if ($prochainEvenement)
        <section>
            <x-section-title title="Prochain événement" />
            <div class="rounded-xl border border-gray-200 bg-white p-6 flex flex-col sm:flex-row items-center gap-6">
                <div class="shrink-0 flex flex-col items-center justify-center h-20 w-20 rounded-lg bg-primary-50 text-primary-700">
                    <span class="text-2xl font-bold">{{ $prochainEvenement->date_heure->format('d') }}</span>
                    <span class="text-xs uppercase font-medium">{{ $prochainEvenement->date_heure->locale('fr')->translatedFormat('M') }}</span>
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h3 class="font-semibold text-gray-900">{{ $prochainEvenement->titre }}</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="ti ti-clock"></i> {{ $prochainEvenement->date_heure->format('H:i') }}
                        @if ($prochainEvenement->lieu)
                            · <i class="ti ti-map-pin"></i> {{ $prochainEvenement->lieu->nom }}
                        @endif
                    </p>
                </div>
                @if ($prochainEvenement->est_fespaco)
                    <x-badge color="secondary"><i class="ti ti-award mr-0.5"></i> FESPACO</x-badge>
                @endif
            </div>
        </section>
    @endif
</div>
@endsection
