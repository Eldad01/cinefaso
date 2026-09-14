@extends('layouts.app')

@section('title', 'Découvrir')

@section('content')
{{-- Bandeau FESPACO --}}
<div class="bg-gradient-to-br from-primary-700 to-primary-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 text-center">
        <i class="ti ti-award text-5xl text-secondary-300"></i>
        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold">Le cinéma burkinabè et africain</h1>
        <p class="mt-3 text-white/90 max-w-2xl mx-auto">
            Ouagadougou est la capitale du cinéma africain, berceau du FESPACO — le plus grand festival de cinéma
            du continent. Découvrez les films, réalisateurs et palmarès qui ont fait cette histoire.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-14">

    {{-- Festival actif --}}
    @if ($festivalActif)
        <section class="rounded-2xl border-2 border-secondary-400 bg-secondary-50 p-6 sm:p-8 flex flex-col sm:flex-row items-center gap-6">
            <i class="ti ti-star-filled text-5xl text-secondary-500 shrink-0"></i>
            <div class="flex-1 text-center sm:text-left">
                <p class="text-secondary-700 font-semibold uppercase text-xs tracking-wide">Festival en cours</p>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}
                </h2>
            </div>
            <a href="{{ route('festival.actif') }}"
               class="shrink-0 inline-flex items-center gap-2 rounded-lg bg-secondary-500 text-white font-semibold px-5 py-2.5 hover:bg-secondary-600 transition">
                Découvrir <i class="ti ti-arrow-right"></i>
            </a>
        </section>
    @endif

    {{-- Films burkinabè --}}
    <section>
        <x-section-title title="Films burkinabè emblématiques" subtitle="Des œuvres qui ont marqué le cinéma national" />
        @if ($filmsBurkinabe->isEmpty())
            <p class="text-gray-500">Aucun film burkinabè référencé pour le moment.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($filmsBurkinabe as $film)
                    <x-card-film :film="$film" />
                @endforeach
            </div>
        @endif
    </section>

    {{-- Réalisateurs burkinabè --}}
    <section>
        <x-section-title title="Réalisateurs burkinabè" subtitle="Les cinéastes derrière ces œuvres" />
        @if ($realisateurs->isEmpty())
            <p class="text-gray-500">Aucun réalisateur référencé pour le moment.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($realisateurs as $realisateur)
                    <div class="rounded-xl border border-gray-200 bg-white p-5">
                        <div class="flex items-center gap-3">
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary-50 text-primary-700">
                                <i class="ti ti-user text-xl"></i>
                            </span>
                            <h3 class="font-semibold text-gray-900">{{ $realisateur['nom'] }}</h3>
                        </div>
                        <p class="mt-3 text-sm text-gray-500">
                            {{ $realisateur['films']->implode(' · ') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Films africains --}}
    <section>
        <x-section-title title="Cinéma africain" subtitle="Une sélection panafricaine" />
        @if ($filmsAfricains->isEmpty())
            <p class="text-gray-500">Aucun film référencé pour le moment.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($filmsAfricains as $film)
                    <x-card-film :film="$film" />
                @endforeach
            </div>
        @endif
    </section>

    {{-- Palmarès --}}
    <section>
        <x-section-title title="Palmarès" subtitle="Les festivals et leurs récompenses" />
        @if ($palmares->isEmpty())
            <p class="text-gray-500">Le palmarès sera bientôt disponible.</p>
        @else
            <div class="space-y-4">
                @foreach ($palmares as $festival)
                    <div class="rounded-xl border border-gray-200 bg-white p-5">
                        <h3 class="font-semibold text-gray-900">
                            {{ $festival->nom }}{{ $festival->edition ? ' — '.$festival->edition : '' }}
                        </h3>
                        <p class="text-xs text-gray-400 mb-2">
                            {{ $festival->date_debut->locale('fr')->translatedFormat('Y') }}
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $festival->palmares }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Articles éditoriaux --}}
    @if ($articles->isNotEmpty())
        <section>
            <x-section-title title="Actualités et portraits" />
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($articles as $article)
                    <article class="rounded-xl border border-gray-200 bg-white overflow-hidden">
                        <div class="h-36 bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if ($article->photo)
                                <img src="{{ Storage::url($article->photo) }}" alt="{{ $article->titre }}" class="h-full w-full object-cover">
                            @else
                                <i class="ti ti-news text-3xl text-gray-300"></i>
                            @endif
                        </div>
                        <div class="p-4">
                            <x-tag>{{ ucfirst($article->type) }}</x-tag>
                            <h3 class="font-semibold text-gray-900 mt-2">{{ $article->titre }}</h3>
                            @if ($article->auteur)
                                <p class="text-xs text-gray-400 mt-1">{{ $article->auteur }}</p>
                            @endif
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3">{{ $article->contenu }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
