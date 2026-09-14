@props(['evenement'])

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

<a href="{{ Route::has('evenement.show') ? route('evenement.show', $evenement) : '#' }}"
   {{ $attributes->merge(['class' => 'group block rounded-xl overflow-hidden bg-cf-surface border border-cf-line hover:border-cf-gold/40 transition']) }}>
    <div class="relative h-28 overflow-hidden" style="background:linear-gradient(150deg,{{ $meta['color'] }} 0 60%,#1D1815 60% 100%)">
        @if ($evenement->affiche)
            <img src="{{ Storage::url($evenement->affiche) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-black/30"></div>
        @else
            <div class="absolute inset-0 flex items-center justify-center">
                <i class="ti {{ $meta['icon'] }} text-4xl text-cf-gold/90"></i>
            </div>
        @endif

        <div class="absolute top-3 left-3 flex flex-col items-center justify-center h-11 w-11 rounded-lg bg-black/45 backdrop-blur-sm">
            <span class="font-display text-base font-bold text-cf-ink leading-none">{{ $evenement->date_heure->format('d') }}</span>
            <span class="text-[9px] uppercase font-semibold text-cf-gold leading-none mt-0.5">{{ $evenement->date_heure->locale('fr')->translatedFormat('M') }}</span>
        </div>

        @if ($evenement->est_fespaco)
            <div class="absolute top-3 right-3 inline-flex items-center gap-1 rounded-full bg-cf-gold px-2 py-1 text-[10px] font-bold text-cf-gold-ink">
                <i class="ti ti-award"></i> FESPACO
            </div>
        @endif
    </div>

    <div class="p-4">
        <h3 class="font-semibold text-cf-ink line-clamp-2 group-hover:text-cf-gold transition">{{ $evenement->titre }}</h3>

        <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm">
            <span class="font-display font-bold text-cf-gold">{{ $evenement->date_heure->format('H:i') }}</span>
            <span class="inline-flex items-center rounded-md bg-cf-surface-2 px-2 py-1 text-[11px] font-medium text-cf-muted">{{ $meta['label'] }}</span>
        </div>

        @if ($evenement->lieu)
            <p class="mt-2 text-xs text-cf-faint truncate flex items-center gap-1">
                <i class="ti ti-map-pin"></i> {{ $evenement->lieu->nom }}
            </p>
        @endif
    </div>
</a>
