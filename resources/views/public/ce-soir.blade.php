@extends('layouts.app')

@section('title', 'Ce soir')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <h1 class="font-display text-2xl sm:text-3xl font-bold text-cf-ink">Ce soir</h1>
        <p class="text-cf-muted mt-1">
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
    <div class="flex flex-wrap gap-2 mb-3 -mx-4 px-4 sm:mx-0 sm:px-0 overflow-x-auto sm:overflow-visible flex-nowrap sm:flex-wrap pb-1">
        <a href="{{ $filterUrl('lieu') }}"
           class="shrink-0 px-3 py-1.5 rounded-full text-sm font-medium {{ ! request('lieu') ? 'bg-cf-gold text-cf-gold-ink' : 'bg-cf-surface text-cf-muted hover:bg-cf-surface-2 border border-cf-line' }}">
            Tous les lieux
        </a>
        @foreach ($lieuxDuSoir as $lieu)
            <a href="{{ $filterUrl('lieu', $lieu->id) }}"
               class="shrink-0 px-3 py-1.5 rounded-full text-sm font-medium {{ (string) request('lieu') === (string) $lieu->id ? 'bg-cf-gold text-cf-gold-ink' : 'bg-cf-surface text-cf-muted hover:bg-cf-surface-2 border border-cf-line' }}">
                {{ $lieu->nom }}
            </a>
        @endforeach
    </div>

    <div class="flex flex-wrap items-center gap-2 mb-8">
        <a href="{{ $filterUrl('genre') }}"
           class="px-3 py-1.5 rounded-full text-sm font-medium {{ ! request('genre') ? 'bg-cf-gold text-cf-gold-ink' : 'bg-cf-surface text-cf-muted hover:bg-cf-surface-2 border border-cf-line' }}">
            Tous les genres
        </a>
        @foreach ($genresDisponibles as $genre)
            <a href="{{ $filterUrl('genre', $genre) }}"
               class="px-3 py-1.5 rounded-full text-sm font-medium {{ request('genre') === $genre ? 'bg-cf-gold text-cf-gold-ink' : 'bg-cf-surface text-cf-muted hover:bg-cf-surface-2 border border-cf-line' }}">
                {{ $genre }}
            </a>
        @endforeach

        <span class="mx-1 text-cf-line hidden sm:inline">|</span>

        <a href="{{ $filterUrl('version') }}"
           class="px-3 py-1.5 rounded-full text-sm font-medium {{ ! request('version') ? 'bg-cf-gold text-cf-gold-ink' : 'bg-cf-surface text-cf-muted hover:bg-cf-surface-2 border border-cf-line' }}">
            Toutes versions
        </a>
        @foreach ($versionsDisponibles as $version)
            <a href="{{ $filterUrl('version', $version) }}"
               class="px-3 py-1.5 rounded-full text-sm font-medium {{ request('version') === $version ? 'bg-cf-gold text-cf-gold-ink' : 'bg-cf-surface text-cf-muted hover:bg-cf-surface-2 border border-cf-line' }}">
                {{ $version }}
            </a>
        @endforeach

        <span class="mx-1 text-cf-line hidden sm:inline">|</span>

        <a href="{{ $filterUrl('fespaco', request('fespaco') ? null : '1') }}"
           class="px-3 py-1.5 rounded-full text-sm font-medium flex items-center gap-1 {{ request('fespaco') ? 'bg-cf-gold text-cf-gold-ink' : 'bg-cf-surface text-cf-muted hover:bg-cf-surface-2 border border-cf-line' }}">
            <i class="ti ti-award"></i> FESPACO
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Liste des séances --}}
        <div class="lg:col-span-2">
            @if ($seances->isEmpty())
                <p class="text-cf-muted">Aucune séance ne correspond à ces critères ce soir.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($seances as $seance)
                        <div class="flex gap-4 rounded-xl border border-cf-line bg-cf-surface p-3 hover:border-cf-gold/40 transition">
                            <a href="{{ Route::has('film.show') ? route('film.show', $seance->film) : '#' }}"
                               class="shrink-0 w-20 rounded-lg overflow-hidden">
                                <x-poster :image="$seance->film->affiche" :label="$seance->film->titre" />
                            </a>
                            <div class="flex-1 min-w-0">
                                <a href="{{ Route::has('film.show') ? route('film.show', $seance->film) : '#' }}"
                                   class="font-semibold text-cf-ink hover:text-cf-gold line-clamp-1 block">
                                    {{ $seance->film->titre }}
                                </a>
                                <p class="text-xs text-cf-faint line-clamp-1">{{ $seance->film->realisateur }}</p>

                                <div class="mt-1.5 flex flex-wrap gap-1">
                                    <span class="inline-flex items-center rounded-md bg-cf-surface-2 px-2 py-1 text-[11px] font-medium text-cf-muted">{{ $seance->version }}</span>
                                    @if ($seance->festival_id)
                                        <span class="inline-flex items-center gap-0.5 rounded-full bg-cf-gold px-2 py-0.5 text-[11px] font-bold text-cf-gold-ink"><i class="ti ti-award"></i> FESPACO</span>
                                    @endif
                                </div>

                                <div class="mt-2 flex items-center justify-between text-sm">
                                    <span class="font-display font-bold text-cf-gold flex items-center gap-1">
                                        {{ $seance->date_heure->format('H:i') }}
                                    </span>
                                    <span class="text-cf-faint">{{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</span>
                                </div>

                                <p class="mt-1 text-xs text-cf-faint truncate">
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
            <div class="rounded-xl border border-cf-line bg-cf-surface p-5 sticky top-24">
                <h3 class="font-semibold text-cf-ink mb-3">Lieux actifs ce soir</h3>
                <ul class="space-y-2">
                    @forelse ($lieuxDuSoir as $lieu)
                        <li>
                            <a href="{{ $filterUrl('lieu', $lieu->id) }}" class="flex items-center justify-between text-sm text-cf-muted hover:text-cf-gold">
                                <span>{{ $lieu->nom }}</span>
                                <span class="text-cf-faint">{{ $lieu->seances_count }}</span>
                            </a>
                        </li>
                    @empty
                        <li class="text-sm text-cf-faint">Aucun lieu actif ce soir.</li>
                    @endforelse
                </ul>
            </div>
        </aside>
    </div>
</div>
@endsection
