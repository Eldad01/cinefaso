@extends('layouts.app')

@section('title', 'Ce soir')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Ce soir</h1>
        <p class="text-gray-500 mt-1">
            {{ now()->locale('fr')->translatedFormat('l d F Y') }}
            · {{ $seances->count() }} séance{{ $seances->count() > 1 ? 's' : '' }}
        </p>
    </div>

    @php
        $filterUrl = function (string $key, $value = null) {
            $params = request()->except($key);
            if ($value !== null && $value !== '') {
                $params[$key] = $value;
            }
            return route('ce-soir', $params);
        };
    @endphp

    {{-- Filtres --}}
    <div class="flex flex-wrap gap-2 mb-3">
        <a href="{{ $filterUrl('lieu') }}"
           class="px-3 py-1.5 rounded-full text-sm font-medium {{ ! request('lieu') ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Tous les lieux
        </a>
        @foreach ($lieuxDuSoir as $lieu)
            <a href="{{ $filterUrl('lieu', $lieu->id) }}"
               class="px-3 py-1.5 rounded-full text-sm font-medium {{ (string) request('lieu') === (string) $lieu->id ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                {{ $lieu->nom }}
            </a>
        @endforeach
    </div>

    <div class="flex flex-wrap items-center gap-2 mb-8">
        <a href="{{ $filterUrl('genre') }}"
           class="px-3 py-1.5 rounded-full text-sm font-medium {{ ! request('genre') ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Tous les genres
        </a>
        @foreach ($genresDisponibles as $genre)
            <a href="{{ $filterUrl('genre', $genre) }}"
               class="px-3 py-1.5 rounded-full text-sm font-medium {{ request('genre') === $genre ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                {{ $genre }}
            </a>
        @endforeach

        <span class="mx-1 text-gray-300 hidden sm:inline">|</span>

        <a href="{{ $filterUrl('version') }}"
           class="px-3 py-1.5 rounded-full text-sm font-medium {{ ! request('version') ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Toutes versions
        </a>
        @foreach ($versionsDisponibles as $version)
            <a href="{{ $filterUrl('version', $version) }}"
               class="px-3 py-1.5 rounded-full text-sm font-medium {{ request('version') === $version ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                {{ $version }}
            </a>
        @endforeach

        <span class="mx-1 text-gray-300 hidden sm:inline">|</span>

        <a href="{{ $filterUrl('fespaco', request('fespaco') ? null : '1') }}"
           class="px-3 py-1.5 rounded-full text-sm font-medium flex items-center gap-1 {{ request('fespaco') ? 'bg-secondary-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            <i class="ti ti-award"></i> FESPACO
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Liste des séances --}}
        <div class="lg:col-span-2">
            @if ($seances->isEmpty())
                <p class="text-gray-500">Aucune séance ne correspond à ces critères ce soir.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($seances as $seance)
                        <div class="flex gap-4 rounded-xl border border-gray-200 bg-white p-3 hover:shadow-md hover:border-primary-200 transition">
                            <a href="{{ Route::has('film.show') ? route('film.show', $seance->film) : '#' }}"
                               class="shrink-0 w-20 aspect-[2/3] rounded-lg bg-gray-100 overflow-hidden">
                                @if ($seance->film->affiche)
                                    <img src="{{ Storage::url($seance->film->affiche) }}" alt="Affiche de {{ $seance->film->titre }}" class="h-full w-full object-cover">
                                @else
                                    <div class="h-full w-full flex items-center justify-center">
                                        <i class="ti ti-movie text-2xl text-gray-300"></i>
                                    </div>
                                @endif
                            </a>
                            <div class="flex-1 min-w-0">
                                <a href="{{ Route::has('film.show') ? route('film.show', $seance->film) : '#' }}"
                                   class="font-semibold text-gray-900 hover:text-primary-600 line-clamp-1 block">
                                    {{ $seance->film->titre }}
                                </a>
                                <p class="text-xs text-gray-500 line-clamp-1">{{ $seance->film->realisateur }}</p>

                                <div class="mt-1.5 flex flex-wrap gap-1">
                                    <x-tag>{{ $seance->version }}</x-tag>
                                    @if ($seance->festival_id)
                                        <x-badge color="secondary"><i class="ti ti-award mr-0.5"></i> FESPACO</x-badge>
                                    @endif
                                </div>

                                <div class="mt-2 flex items-center justify-between text-sm">
                                    <span class="font-medium text-primary-700 flex items-center gap-1">
                                        <i class="ti ti-clock"></i> {{ $seance->date_heure->format('H:i') }}
                                    </span>
                                    <span class="text-gray-500">{{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</span>
                                </div>

                                <p class="mt-1 text-xs text-gray-400 truncate">
                                    <i class="ti ti-map-pin"></i> {{ $seance->lieu->nom }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <aside class="hidden lg:block">
            <div class="rounded-xl border border-gray-200 bg-white p-5 sticky top-24">
                <h3 class="font-semibold text-gray-900 mb-3">Lieux actifs ce soir</h3>
                <ul class="space-y-2">
                    @forelse ($lieuxDuSoir as $lieu)
                        <li>
                            <a href="{{ $filterUrl('lieu', $lieu->id) }}" class="flex items-center justify-between text-sm text-gray-600 hover:text-primary-600">
                                <span>{{ $lieu->nom }}</span>
                                <span class="text-gray-400">{{ $lieu->seances_count }}</span>
                            </a>
                        </li>
                    @empty
                        <li class="text-sm text-gray-400">Aucun lieu actif ce soir.</li>
                    @endforelse
                </ul>
            </div>
        </aside>
    </div>
</div>
@endsection
