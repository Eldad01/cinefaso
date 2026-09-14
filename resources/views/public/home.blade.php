@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

@php
    $heroSeance = $seancesAffiche->first();
    $heroFilm = $heroSeance?->film;
    $heroShapes = [
        ['#6B3A2E', 'circle'],
        ['#164E4A', 'arc'],
        ['#4B4423', 'checker'],
        ['#3B2145', 'ring'],
        ['#2C3E1F', 'triangle'],
    ];
    $heroIndex = abs(crc32((string) ($heroFilm->titre ?? 'CinéFaso'))) % count($heroShapes);
    [$heroColor, $heroShape] = $heroShapes[$heroIndex];
@endphp

{{-- Hero --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0" style="background:linear-gradient(160deg,{{ $heroColor }} 0 45%,#141110 45% 100%)"></div>

    @switch($heroShape)
        @case('circle')
            <svg class="absolute -right-16 -top-16 w-72 text-cf-gold opacity-90" viewBox="0 0 140 140" fill="currentColor"><circle cx="70" cy="70" r="58"/></svg>
            @break
        @case('arc')
            <svg class="absolute -left-10 -bottom-10 w-72 text-cf-gold opacity-80" viewBox="0 0 130 130" fill="currentColor"><path d="M0 110 A110 110 0 0 1 110 0 L110 110 Z"/></svg>
            @break
        @case('checker')
            <svg class="absolute right-6 top-6 w-40 text-cf-gold opacity-90" viewBox="0 0 70 70" fill="currentColor">
                <rect x="0" y="0" width="16" height="16"/><rect x="18" y="18" width="16" height="16"/>
                <rect x="36" y="0" width="16" height="16" opacity=".55"/><rect x="0" y="36" width="16" height="16" opacity=".55"/>
            </svg>
            @break
        @case('ring')
            <svg class="absolute left-10 top-10 w-56 text-cf-gold opacity-85" viewBox="0 0 90 90" fill="currentColor"><path d="M45 4 A41 41 0 1 1 44.9 4 M45 4 A28 28 0 1 0 45 60"/></svg>
            @break
        @case('triangle')
            <svg class="absolute right-8 bottom-8 w-56 text-cf-gold opacity-85" viewBox="0 0 100 100" fill="currentColor"><path d="M50 6 L94 90 L6 90 Z"/></svg>
            @break
    @endswitch

    <div class="absolute inset-0 bg-gradient-to-t from-cf-bg via-cf-bg/10 to-transparent"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-14 sm:pt-16 sm:pb-20">
        <p class="text-cf-gold font-semibold uppercase tracking-wide text-xs sm:text-sm">
            {{ now()->locale('fr')->translatedFormat('l d F Y') }}
        </p>
        <h1 class="mt-3 font-display text-4xl sm:text-6xl font-extrabold text-cf-ink max-w-xl">Ce soir à Ouagadougou</h1>
        <p class="mt-4 text-base sm:text-lg text-cf-muted max-w-md">
            {{ $seancesDuJour->count() }} séance{{ $seancesDuJour->count() > 1 ? 's' : '' }}
            au programme dans {{ $lieuxActifs->where('seances_count', '>', 0)->count() }} lieux
        </p>
        <a href="{{ Route::has('ce-soir') ? route('ce-soir') : '#' }}"
           class="mt-8 inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink font-semibold px-6 py-3 hover:bg-cf-gold-strong transition">
            Voir le programme complet <i class="ti ti-arrow-right"></i>
        </a>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-14">

    {{-- Festival actif --}}
    @if ($festivalActif)
        <section class="rounded-2xl border border-cf-gold/40 bg-cf-surface p-6 sm:p-8 flex flex-col sm:flex-row items-center gap-6">
            <i class="ti ti-star-filled text-5xl text-cf-gold shrink-0"></i>
            <div class="flex-1 text-center sm:text-left">
                <p class="text-cf-gold font-semibold uppercase text-xs tracking-wide">Festival en cours</p>
                <h2 class="font-display text-2xl font-bold text-cf-ink">
                    {{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}
                </h2>
                <p class="text-cf-muted mt-1">
                    du {{ $festivalActif->date_debut->locale('fr')->translatedFormat('d F') }}
                    au {{ $festivalActif->date_fin->locale('fr')->translatedFormat('d F Y') }}
                </p>
            </div>
            <a href="{{ Route::has('festival.actif') ? route('festival.actif') : '#' }}"
               class="shrink-0 inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink font-semibold px-5 py-2.5 hover:bg-cf-gold-strong transition">
                Découvrir <i class="ti ti-arrow-right"></i>
            </a>
        </section>
    @endif

    {{-- Films à l'affiche --}}
    <section>
        <x-section-title title="Films à l'affiche ce soir" subtitle="Une sélection des séances du jour">
            <x-slot name="actions">
                <a href="{{ Route::has('ce-soir') ? route('ce-soir') : '#' }}" class="text-sm font-medium text-cf-gold hover:text-cf-gold-strong">
                    Voir tout <i class="ti ti-arrow-right"></i>
                </a>
            </x-slot>
        </x-section-title>

        @if ($seancesAffiche->isEmpty())
            <p class="text-cf-muted">Aucune séance programmée aujourd'hui pour le moment.</p>
        @else
            <div class="-mx-4 px-4 sm:mx-0 sm:px-0 flex sm:grid sm:grid-cols-3 lg:grid-cols-4 gap-4 overflow-x-auto sm:overflow-visible snap-x snap-mandatory pb-2">
                @foreach ($seancesAffiche as $seance)
                    <x-card-film :seance="$seance" class="w-40 sm:w-auto shrink-0 sm:shrink snap-start" />
                @endforeach
            </div>
        @endif
    </section>

    {{-- Les lieux --}}
    <section>
        <x-section-title title="Les salles" subtitle="Cinémas et lieux partenaires à Ouagadougou">
            <x-slot name="actions">
                <a href="{{ Route::has('lieux.index') ? route('lieux.index') : '#' }}" class="text-sm font-medium text-cf-gold hover:text-cf-gold-strong">
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
            <x-section-title title="Prochain événement" subtitle="Avant-premières, débats et cérémonies">
                <x-slot name="actions">
                    <a href="{{ route('agenda') }}" class="text-sm font-medium text-cf-gold hover:text-cf-gold-strong">
                        Tout l'agenda <i class="ti ti-arrow-right"></i>
                    </a>
                </x-slot>
            </x-section-title>

            <div class="max-w-md">
                <x-card-evenement :evenement="$prochainEvenement" />
            </div>
        </section>
    @endif
</div>
@endsection
