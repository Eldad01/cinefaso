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
                <h2 class="font-display font-bold text-cf-ink mb-3">Programme de la semaine</h2>

                <div class="rounded-2xl border border-cf-gold/30 bg-cf-surface overflow-hidden">
                    <div class="px-5 py-5 text-center bg-cf-surface-2 border-b border-cf-line">
                        <p class="font-display text-xl font-extrabold text-cf-ink uppercase tracking-wide">{{ $lieu->nom }}</p>
                        <p class="mt-1 text-xs font-semibold uppercase tracking-widest text-cf-gold">
                            Programme du {{ $jours->first()->locale('fr')->translatedFormat('d M') }} au {{ $jours->last()->locale('fr')->translatedFormat('d M Y') }}
                        </p>
                    </div>

                    @if ($programme->isEmpty())
                        <p class="p-6 text-center text-sm text-cf-faint">Aucune séance programmée cette semaine.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm border-collapse">
                                <thead>
                                    <tr class="border-b border-cf-line">
                                        <th class="sticky left-0 z-10 bg-cf-surface-2 px-4 py-3 text-left font-semibold text-cf-ink min-w-[150px]">Film</th>
                                        @foreach ($jours as $jour)
                                            <th class="px-3 py-3 text-center font-semibold min-w-[80px]">
                                                <div class="text-[10px] uppercase tracking-wide {{ $jour->isToday() ? 'text-cf-gold' : 'text-cf-muted' }}">{{ $jour->locale('fr')->translatedFormat('D') }}</div>
                                                <div class="font-display text-base font-bold {{ $jour->isToday() ? 'text-cf-gold' : 'text-cf-ink' }}">{{ $jour->format('d') }}</div>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programme as $entry)
                                        <tr class="border-b border-cf-line last:border-b-0">
                                            <td class="sticky left-0 z-10 bg-cf-surface px-4 py-3 align-top">
                                                <a href="{{ Route::has('film.show') ? route('film.show', $entry['film']) : '#' }}" class="font-semibold text-cf-ink hover:text-cf-gold transition line-clamp-2">
                                                    {{ $entry['film']->titre }}
                                                </a>
                                                <p class="text-[11px] text-cf-faint mt-0.5">{{ $entry['film']->genre }} · {{ $entry['film']->duree_min }} min</p>
                                            </td>
                                            @foreach ($jours as $jour)
                                                @php $seancesJour = $entry['parJour']->get($jour->format('Y-m-d')); @endphp
                                                <td class="px-2 py-3 text-center align-top">
                                                    @if ($seancesJour)
                                                        <div class="flex flex-col items-center gap-1">
                                                            @foreach ($seancesJour as $s)
                                                                <a href="{{ Route::has('film.show') ? route('film.show', $entry['film']) : '#' }}"
                                                                   class="inline-flex flex-col items-center rounded-lg bg-cf-surface-2 px-2 py-1 hover:bg-cf-gold/10 transition">
                                                                    <span class="font-display text-xs font-bold text-cf-gold">{{ $s->date_heure->format('H:i') }}</span>
                                                                    <span class="text-[9px] font-semibold text-cf-faint">{{ $s->version }}</span>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-cf-line">—</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    {{-- Partenaires (à venir) --}}
                    <div class="px-5 py-6 border-t border-cf-line">
                        <p class="text-center text-[11px] uppercase tracking-widest text-cf-faint mb-4">Nos partenaires</p>
                        <div class="flex flex-wrap items-center justify-center gap-4">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="h-14 w-14 rounded-full border-2 border-dashed border-cf-line bg-cf-surface-2"></div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            @if ($prochainsEvenements->isNotEmpty())
                <div>
                    <h2 class="font-display font-bold text-cf-ink mb-3">Prochains événements</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($prochainsEvenements as $evenement)
                            <x-card-evenement :evenement="$evenement" />
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
