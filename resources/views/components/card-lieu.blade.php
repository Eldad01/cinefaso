@props(['lieu', 'ouvertCeSoir' => null, 'filmsCount' => null])

<a href="{{ Route::has('lieux.show') ? route('lieux.show', $lieu) : '#' }}"
   {{ $attributes->merge(['class' => 'block rounded-xl border border-gray-200 bg-white overflow-hidden hover:shadow-md hover:border-primary-200 transition']) }}>
    <div class="h-36 bg-gray-100 flex items-center justify-center overflow-hidden">
        @if ($lieu->photo)
            <img src="{{ Storage::url($lieu->photo) }}" alt="{{ $lieu->nom }}" class="h-full w-full object-cover">
        @else
            <i class="ti ti-building text-4xl text-gray-300"></i>
        @endif
    </div>
    <div class="p-4">
        <div class="flex items-start justify-between gap-2">
            <h3 class="font-semibold text-gray-900">{{ $lieu->nom }}</h3>
            @if (! is_null($ouvertCeSoir))
                <x-badge :color="$ouvertCeSoir ? 'success' : 'gray'">
                    {{ $ouvertCeSoir ? 'Ouvert ce soir' : 'Fermé ce soir' }}
                </x-badge>
            @endif
        </div>
        <p class="mt-1 text-sm text-gray-500 flex items-center gap-1">
            <i class="ti ti-map-pin"></i> {{ $lieu->adresse }}
        </p>
        <div class="mt-2 flex flex-wrap items-center gap-2">
            @if ($lieu->type === 'lieu_temporaire')
                <x-tag>Lieu temporaire</x-tag>
            @endif
            @if (! is_null($filmsCount))
                <span class="text-xs text-gray-400">{{ $filmsCount }} film{{ $filmsCount > 1 ? 's' : '' }} ce soir</span>
            @endif
        </div>
    </div>
</a>
