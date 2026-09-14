@props(['lieu', 'ouvertCeSoir' => null, 'filmsCount' => null])

<a href="{{ Route::has('lieux.show') ? route('lieux.show', $lieu) : '#' }}"
   {{ $attributes->merge(['class' => 'block rounded-xl overflow-hidden bg-cf-surface border border-cf-line hover:border-cf-gold/40 transition']) }}>
    <div class="relative">
        <x-poster :image="$lieu->photo" :label="$lieu->nom" aspect="" iconClass="ti-building" class="h-36" />

        @if (! is_null($ouvertCeSoir))
            <div class="absolute top-3 right-3 flex items-center gap-1.5 rounded-full backdrop-blur-md px-2.5 py-1 {{ $ouvertCeSoir ? 'bg-cf-ok/20' : 'bg-black/40' }}">
                <span class="h-1.5 w-1.5 rounded-full {{ $ouvertCeSoir ? 'bg-cf-ok' : 'bg-cf-faint' }}"></span>
                <span class="text-[11px] font-bold {{ $ouvertCeSoir ? 'text-cf-ok' : 'text-cf-muted' }}">
                    {{ $ouvertCeSoir ? 'Ouvert ce soir' : 'Fermé ce soir' }}
                </span>
            </div>
        @endif
    </div>
    <div class="p-4">
        <h3 class="font-semibold text-cf-ink">{{ $lieu->nom }}</h3>
        <p class="mt-1 text-sm text-cf-faint flex items-center gap-1">
            <i class="ti ti-map-pin"></i> {{ $lieu->adresse }}
        </p>
        <div class="mt-2 flex flex-wrap items-center gap-2">
            @if ($lieu->type === 'lieu_temporaire')
                <span class="inline-flex items-center rounded-md bg-cf-surface-2 px-2 py-1 text-[11px] font-medium text-cf-muted">Lieu temporaire</span>
            @endif
            @if (! is_null($filmsCount))
                <span class="text-xs text-cf-faint">{{ $filmsCount }} film{{ $filmsCount > 1 ? 's' : '' }} ce soir</span>
            @endif
        </div>
    </div>
</a>
