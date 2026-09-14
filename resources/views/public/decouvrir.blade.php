@extends('layouts.app')

@section('title', 'Découvrir')

@section('content')
{{-- Bandeau FESPACO --}}
<div class="relative overflow-hidden">
    <div class="absolute inset-0" style="background:linear-gradient(160deg,#4B4423 0 45%,#141110 45% 100%)"></div>
    <svg class="absolute -right-10 -top-10 w-64 text-cf-gold opacity-80" viewBox="0 0 140 140" fill="currentColor"><circle cx="70" cy="70" r="58"/></svg>
    <div class="absolute inset-0 bg-gradient-to-b from-black/10 to-cf-bg"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 text-center">
        <i class="ti ti-award text-5xl text-cf-gold"></i>
        <h1 class="mt-3 font-display text-3xl sm:text-4xl font-extrabold text-cf-ink">Le cinéma burkinabè et africain</h1>
        <p class="mt-3 text-cf-muted max-w-2xl mx-auto">
            Ouagadougou est la capitale du cinéma africain, berceau du FESPACO — le plus grand festival de cinéma
            du continent. Découvrez les films, réalisateurs et palmarès qui ont fait cette histoire.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-14">

    {{-- Festival actif --}}
    @if ($festivalActif)
        <section class="rounded-2xl border border-cf-gold/40 bg-cf-surface p-6 sm:p-8 flex flex-col sm:flex-row items-center gap-6">
            <i class="ti ti-star-filled text-5xl text-cf-gold shrink-0"></i>
            <div class="flex-1 text-center sm:text-left">
                <p class="text-cf-gold font-semibold uppercase text-xs tracking-wide">Festival en cours</p>
                <h2 class="font-display text-2xl font-bold text-cf-ink">
                    {{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}
                </h2>
            </div>
            <a href="{{ route('festival.actif') }}"
               class="shrink-0 inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink font-semibold px-5 py-2.5 hover:bg-cf-gold-strong transition">
                Découvrir <i class="ti ti-arrow-right"></i>
            </a>
        </section>
    @endif

    {{-- Films burkinabè --}}
    <section>
        <x-section-title title="Films burkinabè emblématiques" subtitle="Des œuvres qui ont marqué le cinéma national" />
        @if ($filmsBurkinabe->isEmpty())
            <p class="text-cf-muted">Aucun film burkinabè référencé pour le moment.</p>
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
            <p class="text-cf-muted">Aucun réalisateur référencé pour le moment.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($realisateurs as $realisateur)
                    <div class="rounded-xl border border-cf-line bg-cf-surface p-5">
                        <div class="flex items-center gap-3">
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-cf-surface-2 text-cf-gold">
                                <i class="ti ti-user text-xl"></i>
                            </span>
                            <h3 class="font-semibold text-cf-ink">{{ $realisateur['nom'] }}</h3>
                        </div>
                        <p class="mt-3 text-sm text-cf-muted">
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
            <p class="text-cf-muted">Aucun film référencé pour le moment.</p>
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
            <p class="text-cf-muted">Le palmarès sera bientôt disponible.</p>
        @else
            <div class="space-y-4">
                @foreach ($palmares as $festival)
                    <div class="rounded-xl border border-cf-line bg-cf-surface p-5">
                        <h3 class="font-semibold text-cf-ink">
                            {{ $festival->nom }}{{ $festival->edition ? ' — '.$festival->edition : '' }}
                        </h3>
                        <p class="text-xs text-cf-faint mb-2">
                            {{ $festival->date_debut->locale('fr')->translatedFormat('Y') }}
                        </p>
                        <p class="text-cf-muted text-sm leading-relaxed whitespace-pre-line">{{ $festival->palmares }}</p>
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
                    <article class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
                        <x-poster :image="$article->photo" :label="$article->titre" aspect="" iconClass="ti-news" class="h-36" />
                        <div class="p-4">
                            <span class="inline-flex items-center rounded-md bg-cf-surface-2 px-2 py-1 text-[11px] font-medium text-cf-muted">{{ ucfirst($article->type) }}</span>
                            <h3 class="font-semibold text-cf-ink mt-2">{{ $article->titre }}</h3>
                            @if ($article->auteur)
                                <p class="text-xs text-cf-faint mt-1">{{ $article->auteur }}</p>
                            @endif
                            <p class="text-sm text-cf-muted mt-2 line-clamp-3">{{ $article->contenu }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
