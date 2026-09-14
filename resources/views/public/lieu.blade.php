@extends('layouts.app')

@section('title', $lieu->nom)

@section('content')
<div class="max-w-5xl mx-auto sm:px-6 sm:pt-10 lg:px-8">
    <x-poster :image="$lieu->photo" :label="$lieu->nom" aspect="" iconClass="ti-building" class="h-48 sm:h-72 sm:rounded-xl" />
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-cf-ink">{{ $lieu->nom }}</h1>
            <p class="text-cf-muted mt-1 flex items-center gap-1">
                <i class="ti ti-map-pin"></i> {{ $lieu->adresse }}, {{ $lieu->ville }}
            </p>
        </div>
        <div class="flex items-center gap-1.5 rounded-full px-3 py-1.5 {{ $seancesDuSoir->isNotEmpty() ? 'bg-cf-ok/15' : 'bg-cf-surface-2' }}">
            <span class="h-1.5 w-1.5 rounded-full {{ $seancesDuSoir->isNotEmpty() ? 'bg-cf-ok' : 'bg-cf-faint' }}"></span>
            <span class="text-xs font-bold {{ $seancesDuSoir->isNotEmpty() ? 'text-cf-ok' : 'text-cf-muted' }}">
                {{ $seancesDuSoir->isNotEmpty() ? 'Ouvert ce soir' : 'Fermé ce soir' }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            @if ($lieu->description)
                <p class="text-cf-muted leading-relaxed">{{ $lieu->description }}</p>
            @endif

            <div>
                <h2 class="font-display font-bold text-cf-ink mb-3">Séances de ce soir</h2>
                @if ($seancesDuSoir->isEmpty())
                    <p class="text-cf-faint text-sm">Aucune séance programmée ce soir.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($seancesDuSoir as $seance)
                            <a href="{{ Route::has('film.show') ? route('film.show', $seance->film) : '#' }}"
                               class="flex items-center justify-between gap-3 rounded-lg border border-cf-line bg-cf-surface p-3 hover:border-cf-gold/40 transition">
                                <div>
                                    <p class="font-medium text-cf-ink">{{ $seance->film->titre }}</p>
                                    <p class="text-xs text-cf-faint">{{ $seance->version }} · {{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</p>
                                </div>
                                <span class="font-display font-bold text-cf-gold">{{ $seance->date_heure->format('H:i') }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($prochainsEvenements->isNotEmpty())
                <div>
                    <h2 class="font-display font-bold text-cf-ink mb-3">Prochains événements</h2>
                    <div class="space-y-3">
                        @foreach ($prochainsEvenements as $evenement)
                            <div class="rounded-lg border border-cf-line bg-cf-surface p-3">
                                <p class="font-medium text-cf-ink">{{ $evenement->titre }}</p>
                                <p class="text-xs text-cf-faint">{{ $evenement->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <aside class="space-y-4">
            <div class="rounded-xl border border-cf-line bg-cf-surface p-5 space-y-3 text-sm">
                @if ($lieu->telephone)
                    <p class="flex items-center gap-2 text-cf-muted"><i class="ti ti-phone text-cf-gold"></i> {{ $lieu->telephone }}</p>
                @endif
                @if ($lieu->horaires)
                    <p class="flex items-center gap-2 text-cf-muted"><i class="ti ti-clock text-cf-gold"></i> {{ $lieu->horaires }}</p>
                @endif
                @if ($lieu->tarifs)
                    <p class="flex items-center gap-2 text-cf-muted"><i class="ti ti-ticket text-cf-gold"></i> {{ $lieu->tarifs }}</p>
                @endif
            </div>

            @if ($lieu->latitude && $lieu->longitude)
                <div class="rounded-xl overflow-hidden border border-cf-line h-56">
                    <iframe
                        src="https://maps.google.com/maps?q={{ $lieu->latitude }},{{ $lieu->longitude }}&z=15&output=embed"
                        class="w-full h-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            @endif
        </aside>
    </div>
</div>
@endsection
