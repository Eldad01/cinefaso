@extends('layouts.app')

@section('title', 'Agenda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <x-section-title title="Agenda" subtitle="Événements, avant-premières et rencontres à venir" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-10">
            @forelse ($evenements as $mois => $items)
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 capitalize mb-4">{{ $mois }}</h2>
                    <div class="space-y-3">
                        @foreach ($items as $evenement)
                            <div class="rounded-xl border-l-4 {{ $evenement->est_fespaco ? 'border-primary-600' : 'border-secondary-500' }} bg-white border border-gray-200 p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-xs text-gray-400">{{ $evenement->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</p>
                                        <h3 class="font-semibold text-gray-900 mt-0.5">{{ $evenement->titre }}</h3>
                                        @if ($evenement->lieu)
                                            <p class="text-sm text-gray-500 mt-1"><i class="ti ti-map-pin"></i> {{ $evenement->lieu->nom }}</p>
                                        @endif
                                    </div>
                                    @if ($evenement->est_fespaco)
                                        <x-badge color="primary"><i class="ti ti-award mr-0.5"></i> FESPACO</x-badge>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucun événement à venir pour le moment.</p>
            @endforelse
        </div>

        <aside class="hidden lg:block">
            <div class="rounded-xl border border-gray-200 bg-white p-5 sticky top-24">
                <h3 class="font-semibold text-gray-900 mb-3">Prochains temps forts</h3>
                <ul class="space-y-3">
                    @forelse ($prochains as $evenement)
                        <li class="text-sm">
                            <p class="text-gray-900 font-medium">{{ $evenement->titre }}</p>
                            <p class="text-gray-400 text-xs">{{ $evenement->date_heure->locale('fr')->translatedFormat('d M · H:i') }}</p>
                        </li>
                    @empty
                        <li class="text-sm text-gray-400">Rien de prévu prochainement.</li>
                    @endforelse
                </ul>
            </div>
        </aside>
    </div>
</div>
@endsection
