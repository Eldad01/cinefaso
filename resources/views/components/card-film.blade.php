@props(['seance' => null, 'film' => null])

@php
    $film = $film ?? $seance?->film;
@endphp

@if ($film)
    <a href="{{ Route::has('film.show') ? route('film.show', $film) : '#' }}"
       {{ $attributes->merge(['class' => 'group block rounded-xl overflow-hidden bg-cf-surface border border-cf-line hover:border-cf-gold/40 transition']) }}>
        <x-poster :image="$film->affiche" :label="$film->titre" class="group-hover:opacity-90 transition" />

        <div class="p-3">
            <h3 class="font-semibold text-cf-ink line-clamp-1">{{ $film->titre }}</h3>
            <p class="text-xs text-cf-faint line-clamp-1">{{ $film->realisateur }}</p>

            <div class="mt-2 flex flex-wrap items-center gap-1.5">
                <span class="inline-flex items-center rounded-md bg-cf-surface-2 px-2 py-1 text-[11px] font-medium text-cf-muted">{{ $film->genre }}</span>
                @if ($seance)
                    <span class="inline-flex items-center rounded-md bg-cf-surface-2 px-2 py-1 text-[11px] font-medium text-cf-muted">{{ $seance->version }}</span>
                @endif
                @if ($film->est_burkinabe)
                    <span class="inline-flex items-center rounded-full bg-cf-gold px-2 py-0.5 text-[11px] font-bold text-cf-gold-ink">🇧🇫</span>
                @endif
                @if ($film->prix_fespaco)
                    <span class="inline-flex items-center gap-0.5 rounded-full bg-cf-gold px-2 py-0.5 text-[11px] font-bold text-cf-gold-ink"><i class="ti ti-award"></i></span>
                @endif
            </div>

            @if ($seance)
                <div class="mt-3 flex items-center justify-between text-sm border-t border-cf-line pt-2">
                    <span class="flex items-center gap-1 font-display font-bold text-cf-gold">
                        {{ $seance->date_heure->format('H:i') }}
                    </span>
                    <span class="text-cf-faint truncate max-w-[55%]">{{ $seance->lieu->nom }}</span>
                </div>
            @endif
        </div>
    </a>
@endif
