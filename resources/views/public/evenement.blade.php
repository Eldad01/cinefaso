@extends('layouts.app')

@section('title', $evenement->titre)

@section('content')

@php
    $typeMeta = [
        'avant_premiere' => ['label' => 'Avant-première', 'icon' => 'ti-ticket', 'color' => '#6B3A2E'],
        'debat' => ['label' => 'Débat', 'icon' => 'ti-microphone-2', 'color' => '#164E4A'],
        'ceremonie' => ['label' => 'Cérémonie', 'icon' => 'ti-award', 'color' => '#3B2145'],
        'projection_speciale' => ['label' => 'Projection spéciale', 'icon' => 'ti-movie', 'color' => '#4B4423'],
        'autre' => ['label' => 'Autre', 'icon' => 'ti-calendar-event', 'color' => '#2C3E1F'],
    ];
    $meta = $typeMeta[$evenement->type] ?? $typeMeta['autre'];
@endphp

{{-- Backdrop --}}
<div class="relative h-48 sm:h-64 overflow-hidden" style="background:linear-gradient(150deg,{{ $meta['color'] }} 0 60%,#1D1815 60% 100%)">
    @if ($evenement->affiche)
        <img src="{{ Storage::url($evenement->affiche) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>
    @else
        <div class="absolute inset-0 flex items-center justify-center">
            <i class="ti {{ $meta['icon'] }} text-7xl text-cf-gold/90"></i>
        </div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-cf-bg"></div>

    <a href="{{ route('agenda') }}" class="absolute top-5 left-4 sm:left-6 inline-flex items-center gap-1.5 rounded-full bg-cf-surface border border-cf-line px-3.5 py-2 text-sm font-semibold text-cf-ink shadow-lg shadow-black/40 hover:border-cf-gold/50 hover:text-cf-gold transition">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Retour
    </a>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-14 sm:-mt-16 relative pb-16">

    <div class="flex flex-wrap items-center gap-2">
        <div class="flex flex-col items-center justify-center h-16 w-16 rounded-xl bg-cf-surface border border-cf-line shrink-0">
            <span class="font-display text-2xl font-bold text-cf-ink leading-none">{{ $evenement->date_heure->format('d') }}</span>
            <span class="text-[10px] uppercase font-semibold text-cf-gold leading-none mt-1">{{ $evenement->date_heure->locale('fr')->translatedFormat('M') }}</span>
        </div>

        <div class="flex-1 min-w-0 pt-8">
            <div class="flex flex-wrap gap-1.5">
                <span class="inline-flex items-center rounded-full bg-cf-surface border border-cf-line px-3 py-1 text-xs font-semibold text-cf-muted">
                    <i class="ti {{ $meta['icon'] }} mr-1"></i> {{ $meta['label'] }}
                </span>
                @if ($evenement->est_fespaco)
                    <span class="inline-flex items-center gap-1 rounded-full bg-cf-gold px-3 py-1 text-xs font-bold text-cf-gold-ink">
                        <i class="ti ti-award"></i> FESPACO
                    </span>
                @endif
                @if ($evenement->festival)
                    <a href="{{ route('festival.show', $evenement->festival) }}" class="inline-flex items-center rounded-full bg-cf-surface-2 px-3 py-1 text-xs font-semibold text-cf-ink hover:text-cf-gold transition">
                        {{ $evenement->festival->nom }}{{ $evenement->festival->edition ? ' — '.$evenement->festival->edition : '' }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    <h1 class="mt-4 font-display text-2xl sm:text-3xl font-extrabold text-cf-ink">{{ $evenement->titre }}</h1>

    <div class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm">
        <span class="flex items-center gap-1.5 font-display font-bold text-cf-gold">
            {{ $evenement->date_heure->locale('fr')->translatedFormat('l d F Y') }} · {{ $evenement->date_heure->format('H:i') }}
        </span>
        @if ($evenement->lieu)
            <a href="{{ route('lieux.show', $evenement->lieu) }}" class="flex items-center gap-1.5 text-cf-muted hover:text-cf-gold transition">
                <i class="ti ti-map-pin"></i> {{ $evenement->lieu->nom }}
            </a>
        @endif
    </div>

    @if ($evenement->description)
        <div class="mt-8">
            <h2 class="font-display font-bold text-cf-ink mb-2">À propos</h2>
            <p class="text-cf-muted leading-relaxed whitespace-pre-line">{{ $evenement->description }}</p>
        </div>
    @endif

    @if ($evenement->lieu)
        <div class="mt-8 rounded-xl border border-cf-line bg-cf-surface p-5">
            <h2 class="font-display font-bold text-cf-ink mb-3">Cinéma</h2>
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-semibold text-cf-ink">{{ $evenement->lieu->nom }}</p>
                    <p class="text-sm text-cf-muted mt-1 flex items-center gap-1">
                        <i class="ti ti-map-pin"></i> {{ $evenement->lieu->adresse }}, {{ $evenement->lieu->ville }}
                    </p>
                </div>
                <a href="{{ route('lieux.show', $evenement->lieu) }}"
                   class="shrink-0 inline-flex items-center gap-1 rounded-lg border border-cf-line px-3 py-2 text-sm font-semibold text-cf-ink hover:border-cf-gold/50 transition">
                    Voir le cinéma <i class="ti ti-arrow-right"></i>
                </a>
            </div>
        </div>
    @endif

    @if ($autresEvenements->isNotEmpty())
        <div class="mt-12">
            <h2 class="font-display text-lg font-bold text-cf-ink mb-4">Autres événements à venir</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach ($autresEvenements as $autre)
                    <x-card-evenement :evenement="$autre" />
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
