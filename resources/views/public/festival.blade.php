@extends('layouts.app')

@section('title', $festival->nom)

@section('content')
<div class="relative overflow-hidden">
    <div class="absolute inset-0" style="background:linear-gradient(160deg,#6B3A2E 0 45%,#141110 45% 100%)"></div>
    <svg class="absolute -left-10 -bottom-10 w-64 text-cf-gold opacity-80" viewBox="0 0 130 130" fill="currentColor"><path d="M0 110 A110 110 0 0 1 110 0 L110 110 Z"/></svg>
    <div class="absolute inset-0 bg-gradient-to-b from-black/10 to-cf-bg"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 text-center">
        <p class="text-cf-gold font-semibold uppercase tracking-wide text-sm">Festival</p>
        <h1 class="mt-2 font-display text-3xl sm:text-5xl font-extrabold text-cf-ink">
            {{ $festival->nom }}{{ $festival->edition ? ' — '.$festival->edition : '' }}
        </h1>
        <p class="mt-4 text-cf-muted">
            du {{ $festival->date_debut->locale('fr')->translatedFormat('d F') }}
            au {{ $festival->date_fin->locale('fr')->translatedFormat('d F Y') }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-14">
    @if ($festival->description)
        <p class="text-cf-muted leading-relaxed max-w-3xl">{{ $festival->description }}</p>
    @endif

    {{-- Programme par catégorie --}}
    <section>
        <x-section-title title="Programme" />
        @forelse ($seancesParCategorie as $categorie => $seances)
            <div class="mb-8">
                <h3 class="font-semibold text-cf-ink capitalize mb-3">{{ str_replace('_', ' ', $categorie) }}</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($seances as $seance)
                        <x-card-film :seance="$seance" />
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-cf-muted">Le programme sera bientôt disponible.</p>
        @endforelse
    </section>

    {{-- Lieux participants --}}
    @if ($lieuxParticipants->isNotEmpty())
        <section>
            <x-section-title title="Cinémas participants" />
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($lieuxParticipants as $lieu)
                    <x-card-lieu :lieu="$lieu" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- Événements --}}
    @if ($evenements->isNotEmpty())
        <section>
            <x-section-title title="Événements et cérémonies" />
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($evenements as $evenement)
                    <x-card-evenement :evenement="$evenement" />
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
