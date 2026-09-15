@extends('layouts.superadmin')

@section('page-title', 'Tableau de bord')

@section('content')
    @if ($festivalActif)
        <div class="mb-6 rounded-xl border-2 border-cf-gold/50 bg-cf-surface-2 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <p class="text-sm text-cf-ink">
                <i class="ti ti-star-filled text-cf-gold mr-1"></i>
                Festival actif : <strong class="text-cf-gold">{{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}</strong>
            </p>
            <a href="{{ route('superadmin.festivals.programme', $festivalActif) }}" class="shrink-0 text-sm font-semibold text-cf-gold hover:text-cf-gold-strong">
                Gérer le programme <i class="ti ti-arrow-right"></i>
            </a>
        </div>
    @endif

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="rounded-xl border border-cf-line bg-cf-surface p-5">
            <p class="text-xs text-cf-faint uppercase font-medium">Cinémas actifs</p>
            <p class="mt-1 text-3xl font-bold text-cf-ink">{{ $lieuxActifsCount }}</p>
        </div>
        <div class="rounded-xl border border-cf-line bg-cf-surface p-5">
            <p class="text-xs text-cf-faint uppercase font-medium">Séances publiées</p>
            <p class="mt-1 text-3xl font-bold text-cf-ink">{{ $seancesCount }}</p>
        </div>
        <div class="rounded-xl border border-cf-line bg-cf-surface p-5">
            <p class="text-xs text-cf-faint uppercase font-medium">Rappels activés</p>
            <p class="mt-1 text-3xl font-bold text-cf-ink">{{ $rappelsCount }}</p>
        </div>
        <div class="rounded-xl border border-cf-line bg-cf-surface p-5">
            <p class="text-xs text-cf-faint uppercase font-medium">Films en base</p>
            <p class="mt-1 text-3xl font-bold text-cf-ink">{{ $filmsCount }}</p>
        </div>
        <div class="rounded-xl border border-cf-line bg-cf-surface p-5">
            <p class="text-xs text-cf-faint uppercase font-medium">Vues cumulées</p>
            <p class="mt-1 text-3xl font-bold text-cf-ink">{{ $vuesTotal }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
            <div class="px-5 py-4 border-b border-cf-line">
                <h2 class="font-semibold text-cf-ink">Cinémas les plus actifs</h2>
            </div>
            @if ($lieuxPlusActifs->isEmpty())
                <p class="p-5 text-cf-muted text-sm">Aucun cinéma pour le moment.</p>
            @else
                <ul class="divide-y divide-cf-line">
                    @foreach ($lieuxPlusActifs as $lieu)
                        <li class="px-5 py-3 flex items-center justify-between text-sm">
                            <span class="font-medium text-cf-ink">{{ $lieu->nom }}</span>
                            <span class="text-cf-muted">{{ $lieu->seances_count }} séances</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="rounded-xl border border-cf-line bg-cf-surface p-5">
            <h2 class="font-semibold text-cf-ink mb-4">Accès rapides</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('superadmin.lieux.index') }}" class="rounded-lg border border-cf-line p-3 text-sm font-medium text-cf-muted hover:border-cf-gold/40 hover:text-cf-gold-strong transition">
                    <i class="ti ti-building block mb-1 text-lg"></i> Lieux
                </a>
                <a href="{{ route('superadmin.films.index') }}" class="rounded-lg border border-cf-line p-3 text-sm font-medium text-cf-muted hover:border-cf-gold/40 hover:text-cf-gold-strong transition">
                    <i class="ti ti-movie block mb-1 text-lg"></i> Films
                </a>
                <a href="{{ route('superadmin.users.index') }}" class="rounded-lg border border-cf-line p-3 text-sm font-medium text-cf-muted hover:border-cf-gold/40 hover:text-cf-gold-strong transition">
                    <i class="ti ti-users block mb-1 text-lg"></i> Utilisateurs
                </a>
                <a href="{{ route('superadmin.festivals.index') }}" class="rounded-lg border border-cf-line p-3 text-sm font-medium text-cf-muted hover:border-cf-gold/40 hover:text-cf-gold-strong transition">
                    <i class="ti ti-star block mb-1 text-lg"></i> Festivals
                </a>
            </div>
        </div>
    </div>
@endsection
