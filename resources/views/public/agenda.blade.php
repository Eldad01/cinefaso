@extends('layouts.app')

@section('title', 'Agenda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <x-section-title title="Agenda" subtitle="Événements, avant-premières et rencontres à venir" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-10">
            @forelse ($evenements as $mois => $items)
                <div>
                    <h2 class="font-display text-lg font-semibold text-cf-ink capitalize mb-4">{{ $mois }}</h2>
                    <div class="space-y-3">
                        @foreach ($items as $evenement)
                            <div class="rounded-xl border-l-4 {{ $evenement->est_fespaco ? 'border-cf-gold' : 'border-cf-line' }} bg-cf-surface border-y border-r border-cf-line p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-xs text-cf-faint">{{ $evenement->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</p>
                                        <h3 class="font-semibold text-cf-ink mt-0.5">{{ $evenement->titre }}</h3>
                                        @if ($evenement->lieu)
                                            <p class="text-sm text-cf-muted mt-1"><i class="ti ti-map-pin"></i> {{ $evenement->lieu->nom }}</p>
                                        @endif
                                    </div>
                                    @if ($evenement->est_fespaco)
                                        <span class="inline-flex items-center gap-0.5 rounded-full bg-cf-gold px-2 py-0.5 text-[11px] font-bold text-cf-gold-ink shrink-0"><i class="ti ti-award"></i> FESPACO</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-cf-muted">Aucun événement à venir pour le moment.</p>
            @endforelse
        </div>

        <aside class="hidden lg:block">
            <div class="rounded-xl border border-cf-line bg-cf-surface p-5 sticky top-24">
                <h3 class="font-semibold text-cf-ink mb-3">Prochains temps forts</h3>
                <ul class="space-y-3">
                    @forelse ($prochains as $evenement)
                        <li class="text-sm">
                            <p class="text-cf-ink font-medium">{{ $evenement->titre }}</p>
                            <p class="text-cf-faint text-xs">{{ $evenement->date_heure->locale('fr')->translatedFormat('d M · H:i') }}</p>
                        </li>
                    @empty
                        <li class="text-sm text-cf-faint">Rien de prévu prochainement.</li>
                    @endforelse
                </ul>
            </div>
        </aside>
    </div>
</div>
@endsection
