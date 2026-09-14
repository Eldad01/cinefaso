@extends('layouts.app')

@section('title', $festival->nom)

@section('content')
<div class="bg-gradient-to-br from-primary-700 to-primary-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 text-center">
        <p class="text-secondary-300 font-semibold uppercase tracking-wide text-sm">Festival</p>
        <h1 class="mt-2 text-3xl sm:text-5xl font-extrabold">
            {{ $festival->nom }}{{ $festival->edition ? ' — '.$festival->edition : '' }}
        </h1>
        <p class="mt-4 text-white/90">
            du {{ $festival->date_debut->locale('fr')->translatedFormat('d F') }}
            au {{ $festival->date_fin->locale('fr')->translatedFormat('d F Y') }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-14">
    @if ($festival->description)
        <p class="text-gray-600 leading-relaxed max-w-3xl">{{ $festival->description }}</p>
    @endif

    {{-- Programme par catégorie --}}
    <section>
        <x-section-title title="Programme" />
        @forelse ($seancesParCategorie as $categorie => $seances)
            <div class="mb-8">
                <h3 class="font-semibold text-gray-900 capitalize mb-3">{{ str_replace('_', ' ', $categorie) }}</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($seances as $seance)
                        <x-card-film :seance="$seance" />
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-gray-500">Le programme sera bientôt disponible.</p>
        @endforelse
    </section>

    {{-- Lieux participants --}}
    @if ($lieuxParticipants->isNotEmpty())
        <section>
            <x-section-title title="Lieux participants" />
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
            <div class="space-y-3">
                @foreach ($evenements as $evenement)
                    <div class="rounded-xl border border-gray-200 bg-white p-4 flex items-center justify-between gap-3">
                        <div>
                            <p class="font-medium text-gray-900">{{ $evenement->titre }}</p>
                            <p class="text-xs text-gray-500">{{ $evenement->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</p>
                        </div>
                        @if ($evenement->lieu)
                            <span class="text-sm text-gray-500">{{ $evenement->lieu->nom }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
