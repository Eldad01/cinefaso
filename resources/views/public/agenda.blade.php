@extends('layouts.app')

@section('title', 'Agenda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <x-section-title title="Agenda" subtitle="Événements, avant-premières et rencontres à venir" />

    @php
        $types = [
            '' => 'Tous',
            'avant_premiere' => 'Avant-premières',
            'debat' => 'Débats',
            'ceremonie' => 'Cérémonies',
            'projection_speciale' => 'Projections spéciales',
            'autre' => 'Autres',
        ];
    @endphp

    <div class="flex flex-wrap gap-2 mb-8 -mx-4 px-4 sm:mx-0 sm:px-0 overflow-x-auto sm:overflow-visible flex-nowrap sm:flex-wrap pb-1">
        @foreach ($types as $value => $label)
            <a href="{{ route('agenda', $value ? ['type' => $value] : []) }}"
               class="shrink-0 px-3 py-1.5 rounded-full text-sm font-medium {{ request('type', '') === $value ? 'bg-cf-gold text-cf-gold-ink' : 'bg-cf-surface text-cf-muted hover:bg-cf-surface-2 border border-cf-line' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-10">
            @forelse ($evenements as $mois => $items)
                <div>
                    <h2 class="font-display text-lg font-semibold text-cf-ink capitalize mb-4">{{ $mois }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($items as $evenement)
                            <x-card-evenement :evenement="$evenement" />
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
                            <a href="{{ route('evenement.show', $evenement) }}" class="text-cf-ink font-medium hover:text-cf-gold transition">{{ $evenement->titre }}</a>
                            <p class="text-cf-faint text-xs mt-0.5">{{ $evenement->date_heure->locale('fr')->translatedFormat('d M · H:i') }}</p>
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
