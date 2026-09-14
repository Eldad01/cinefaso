@extends('layouts.app')

@section('title', $lieu->nom)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="rounded-xl overflow-hidden bg-gray-100 h-56 sm:h-72 mb-6">
        @if ($lieu->photo)
            <img src="{{ Storage::url($lieu->photo) }}" alt="{{ $lieu->nom }}" class="h-full w-full object-cover">
        @else
            <div class="h-full w-full flex items-center justify-center">
                <i class="ti ti-building text-6xl text-gray-300"></i>
            </div>
        @endif
    </div>

    <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $lieu->nom }}</h1>
            <p class="text-gray-500 mt-1 flex items-center gap-1">
                <i class="ti ti-map-pin"></i> {{ $lieu->adresse }}, {{ $lieu->ville }}
            </p>
        </div>
        <x-badge :color="$seancesDuSoir->isNotEmpty() ? 'success' : 'gray'">
            {{ $seancesDuSoir->isNotEmpty() ? 'Ouvert ce soir' : 'Fermé ce soir' }}
        </x-badge>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            @if ($lieu->description)
                <p class="text-gray-600 leading-relaxed">{{ $lieu->description }}</p>
            @endif

            <div>
                <h2 class="font-semibold text-gray-900 mb-3">Séances de ce soir</h2>
                @if ($seancesDuSoir->isEmpty())
                    <p class="text-gray-500 text-sm">Aucune séance programmée ce soir.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($seancesDuSoir as $seance)
                            <a href="{{ Route::has('film.show') ? route('film.show', $seance->film) : '#' }}"
                               class="flex items-center justify-between gap-3 rounded-lg border border-gray-200 bg-white p-3 hover:border-primary-200 hover:shadow-sm transition">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $seance->film->titre }}</p>
                                    <p class="text-xs text-gray-500">{{ $seance->version }} · {{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</p>
                                </div>
                                <span class="font-semibold text-primary-700">{{ $seance->date_heure->format('H:i') }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($prochainsEvenements->isNotEmpty())
                <div>
                    <h2 class="font-semibold text-gray-900 mb-3">Prochains événements</h2>
                    <div class="space-y-3">
                        @foreach ($prochainsEvenements as $evenement)
                            <div class="rounded-lg border border-gray-200 bg-white p-3">
                                <p class="font-medium text-gray-900">{{ $evenement->titre }}</p>
                                <p class="text-xs text-gray-500">{{ $evenement->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <aside class="space-y-4">
            <div class="rounded-xl border border-gray-200 bg-white p-5 space-y-3 text-sm">
                @if ($lieu->telephone)
                    <p class="flex items-center gap-2 text-gray-600"><i class="ti ti-phone text-primary-600"></i> {{ $lieu->telephone }}</p>
                @endif
                @if ($lieu->horaires)
                    <p class="flex items-center gap-2 text-gray-600"><i class="ti ti-clock text-primary-600"></i> {{ $lieu->horaires }}</p>
                @endif
                @if ($lieu->tarifs)
                    <p class="flex items-center gap-2 text-gray-600"><i class="ti ti-ticket text-primary-600"></i> {{ $lieu->tarifs }}</p>
                @endif
            </div>

            @if ($lieu->latitude && $lieu->longitude)
                <div class="rounded-xl overflow-hidden border border-gray-200 h-56">
                    <iframe
                        src="https://maps.google.com/maps?q={{ $lieu->latitude }},{{ $lieu->longitude }}&z=15&output=embed"
                        class="w-full h-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            @endif
        </aside>
    </div>
</div>
@endsection
