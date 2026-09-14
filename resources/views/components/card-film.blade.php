@props(['seance' => null, 'film' => null])

@php
    $film = $film ?? $seance?->film;
@endphp

@if ($film)
    <a href="{{ Route::has('film.show') ? route('film.show', $film) : '#' }}"
       {{ $attributes->merge(['class' => 'group block rounded-xl border border-gray-200 bg-white overflow-hidden hover:shadow-md hover:border-primary-200 transition']) }}>
        <div class="aspect-[2/3] bg-gray-100 overflow-hidden">
            @if ($film->affiche)
                <img src="{{ Storage::url($film->affiche) }}" alt="Affiche de {{ $film->titre }}" class="h-full w-full object-cover group-hover:scale-105 transition">
            @else
                <div class="h-full w-full flex items-center justify-center">
                    <i class="ti ti-movie text-4xl text-gray-300"></i>
                </div>
            @endif
        </div>

        <div class="p-3">
            <h3 class="font-semibold text-gray-900 line-clamp-1">{{ $film->titre }}</h3>
            <p class="text-xs text-gray-500 line-clamp-1">{{ $film->realisateur }}</p>

            <div class="mt-2 flex flex-wrap items-center gap-1.5">
                <x-tag>{{ $film->genre }}</x-tag>
                @if ($seance)
                    <x-tag>{{ $seance->version }}</x-tag>
                @endif
                @if ($film->est_burkinabe)
                    <x-badge color="primary">Burkinabè</x-badge>
                @endif
                @if ($film->prix_fespaco)
                    <x-badge color="secondary"><i class="ti ti-award mr-0.5"></i> FESPACO</x-badge>
                @endif
            </div>

            @if ($seance)
                <div class="mt-3 flex items-center justify-between text-sm border-t border-gray-100 pt-2">
                    <span class="flex items-center gap-1 font-medium text-primary-700">
                        <i class="ti ti-clock"></i> {{ $seance->date_heure->format('H:i') }}
                    </span>
                    <span class="text-gray-500 truncate max-w-[55%]">{{ $seance->lieu->nom }}</span>
                </div>
            @endif
        </div>
    </a>
@endif
