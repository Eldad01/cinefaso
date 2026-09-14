@extends('layouts.app')

@section('title', $film->titre)

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    @if (session('status') === 'rappel-active')
        <x-alert type="success" class="mb-6">Rappel activé ! Vous recevrez un SMS avant le début de la séance.</x-alert>
    @elseif (session('status') === 'rappel-deja-active')
        <x-alert type="info" class="mb-6">Vous avez déjà un rappel actif pour cette séance.</x-alert>
    @endif

    @error('telephone')
        <x-alert type="error" class="mb-6">{{ $message }}</x-alert>
    @enderror

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Affiche --}}
        <div class="md:col-span-1">
            <div class="h-40 sm:h-56 md:h-auto md:aspect-[2/3] rounded-xl bg-gray-100 overflow-hidden md:sticky md:top-24">
                @if ($film->affiche)
                    <img src="{{ Storage::url($film->affiche) }}" alt="Affiche de {{ $film->titre }}" class="h-full w-full object-cover">
                @else
                    <div class="h-full w-full flex items-center justify-center">
                        <i class="ti ti-movie text-5xl md:text-6xl text-gray-300"></i>
                    </div>
                @endif
            </div>
        </div>

        {{-- Détails --}}
        <div class="md:col-span-2">
            <h1 class="text-3xl font-bold text-gray-900">{{ $film->titre }}</h1>
            @if ($film->titre_original && $film->titre_original !== $film->titre)
                <p class="text-gray-500 italic mt-0.5">{{ $film->titre_original }}</p>
            @endif

            <div class="mt-3 flex flex-wrap gap-1.5">
                <x-tag>{{ $film->genre }}</x-tag>
                <x-tag>{{ $film->langue }}</x-tag>
                @if ($film->est_burkinabe)
                    <x-badge color="primary">Film burkinabè</x-badge>
                @elseif ($film->est_africain)
                    <x-badge color="primary">Film africain</x-badge>
                @endif
                @if ($film->prix_fespaco)
                    <x-badge color="secondary"><i class="ti ti-award mr-0.5"></i> {{ $film->prix_fespaco }}</x-badge>
                @endif
            </div>

            <dl class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                <div>
                    <dt class="text-gray-400">Réalisateur</dt>
                    <dd class="font-medium text-gray-900">{{ $film->realisateur }}</dd>
                </div>
                <div>
                    <dt class="text-gray-400">Pays</dt>
                    <dd class="font-medium text-gray-900">{{ $film->pays }}</dd>
                </div>
                <div>
                    <dt class="text-gray-400">Année</dt>
                    <dd class="font-medium text-gray-900">{{ $film->annee }}</dd>
                </div>
                <div>
                    <dt class="text-gray-400">Durée</dt>
                    <dd class="font-medium text-gray-900">{{ $film->duree_min }} min</dd>
                </div>
            </dl>

            @if ($film->synopsis)
                <div class="mt-6">
                    <h2 class="font-semibold text-gray-900 mb-2">Synopsis</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $film->synopsis }}</p>
                </div>
            @endif

            {{-- Séances --}}
            <div class="mt-10">
                <h2 class="font-semibold text-gray-900 mb-4">Séances disponibles</h2>

                @if ($seances->isEmpty())
                    <p class="text-gray-500">Aucune séance à venir pour ce film pour le moment.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($seances as $seance)
                            <div x-data="{ rappelOpen: false }" class="rounded-xl border border-gray-200 bg-white p-4">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $seance->lieu->nom }}</p>
                                        <p class="text-sm text-gray-500">{{ $seance->lieu->adresse }}</p>
                                        <div class="mt-1.5 flex flex-wrap items-center gap-3 text-sm">
                                            <span class="flex items-center gap-1 font-medium text-primary-700">
                                                <i class="ti ti-calendar"></i>
                                                {{ $seance->date_heure->locale('fr')->translatedFormat('D d M') }}
                                                <i class="ti ti-clock ml-1"></i> {{ $seance->date_heure->format('H:i') }}
                                            </span>
                                            <x-tag>{{ $seance->version }}</x-tag>
                                            <span class="text-gray-500">{{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</span>
                                            @if ($seance->festival_id)
                                                <x-badge color="secondary"><i class="ti ti-award mr-0.5"></i> FESPACO</x-badge>
                                            @endif
                                        </div>
                                    </div>
                                    <button @click="rappelOpen = !rappelOpen" type="button"
                                            class="shrink-0 inline-flex items-center gap-1.5 rounded-lg border border-primary-200 text-primary-700 px-4 py-2 text-sm font-semibold hover:bg-primary-50 transition">
                                        <i class="ti ti-bell"></i> Activer un rappel
                                    </button>
                                </div>

                                <form x-show="rappelOpen" x-cloak method="POST" action="{{ route('rappels.store') }}"
                                      class="mt-4 flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                                    @csrf
                                    <input type="hidden" name="seance_id" value="{{ $seance->id }}">
                                    <input type="tel" name="telephone" placeholder="+226 70 00 00 00" required
                                           class="flex-1 min-w-[180px] rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-4 py-2 text-sm font-semibold hover:bg-primary-700 transition">
                                        Confirmer
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
