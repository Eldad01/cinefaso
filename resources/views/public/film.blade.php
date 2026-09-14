@extends('layouts.app')

@section('title', $film->titre)

@section('content')

@php
    $shapes = [
        ['#6B3A2E', 'circle'],
        ['#164E4A', 'arc'],
        ['#4B4423', 'checker'],
        ['#3B2145', 'ring'],
        ['#2C3E1F', 'triangle'],
    ];
    $index = abs(crc32((string) $film->titre)) % count($shapes);
    [$color, $shape] = $shapes[$index];
@endphp

{{-- Backdrop --}}
<div class="relative h-48 sm:h-64 overflow-hidden">
    @if ($film->affiche)
        <img src="{{ Storage::url($film->affiche) }}" alt="" class="h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>
    @else
        <div class="absolute inset-0" style="background:linear-gradient(115deg,{{ $color }} 0 44%,#1D1815 44% 100%)"></div>
        @switch($shape)
            @case('circle')
                <svg class="absolute -right-10 -top-10 w-56 text-cf-gold opacity-90" viewBox="0 0 220 220" fill="currentColor"><circle cx="110" cy="110" r="86"/></svg>
                @break
            @case('arc')
                <svg class="absolute -left-10 -bottom-10 w-56 text-cf-gold opacity-80" viewBox="0 0 130 130" fill="currentColor"><path d="M0 110 A110 110 0 0 1 110 0 L110 110 Z"/></svg>
                @break
            @case('checker')
                <svg class="absolute right-8 top-8 w-32 text-cf-gold opacity-90" viewBox="0 0 70 70" fill="currentColor">
                    <rect x="0" y="0" width="16" height="16"/><rect x="18" y="18" width="16" height="16"/>
                    <rect x="36" y="0" width="16" height="16" opacity=".55"/><rect x="0" y="36" width="16" height="16" opacity=".55"/>
                </svg>
                @break
            @case('ring')
                <svg class="absolute left-8 top-8 w-40 text-cf-gold opacity-85" viewBox="0 0 90 90" fill="currentColor"><path d="M45 4 A41 41 0 1 1 44.9 4 M45 4 A28 28 0 1 0 45 60"/></svg>
                @break
            @case('triangle')
                <svg class="absolute right-8 bottom-8 w-40 text-cf-gold opacity-85" viewBox="0 0 100 100" fill="currentColor"><path d="M50 6 L94 90 L6 90 Z"/></svg>
                @break
        @endswitch
    @endif
    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-cf-bg"></div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 sm:-mt-20 relative">

    @if (session('status') === 'rappel-active')
        <x-alert type="success" class="mb-6">Rappel activé ! Vous recevrez un SMS avant le début de la séance.</x-alert>
    @elseif (session('status') === 'rappel-deja-active')
        <x-alert type="info" class="mb-6">Vous avez déjà un rappel actif pour cette séance.</x-alert>
    @endif

    @error('telephone')
        <x-alert type="error" class="mb-6">{{ $message }}</x-alert>
    @enderror

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-10">
        {{-- Affiche --}}
        <div class="md:col-span-1">
            <div class="flex items-end gap-4 md:block">
                <div class="w-28 sm:w-36 md:w-full shrink-0 rounded-xl overflow-hidden shadow-2xl ring-2 ring-cf-bg md:sticky md:top-24">
                    <x-poster :image="$film->affiche" :label="$film->titre" />
                </div>
                <div class="md:hidden pb-1">
                    <h1 class="font-display text-2xl font-extrabold text-cf-ink leading-tight">{{ $film->titre }}</h1>
                    <p class="text-sm text-cf-muted mt-1">{{ $film->realisateur }}</p>
                </div>
            </div>
        </div>

        {{-- Détails --}}
        <div class="md:col-span-2">
            <div class="hidden md:block">
                <h1 class="font-display text-3xl font-extrabold text-cf-ink">{{ $film->titre }}</h1>
                @if ($film->titre_original && $film->titre_original !== $film->titre)
                    <p class="text-cf-faint italic mt-0.5">{{ $film->titre_original }}</p>
                @endif
                <p class="text-cf-muted mt-1">{{ $film->realisateur }}</p>
            </div>

            <div class="mt-4 md:mt-3 flex flex-wrap gap-1.5">
                <span class="inline-flex items-center rounded-full bg-cf-surface border border-cf-line px-3 py-1.5 text-xs font-semibold text-cf-muted">{{ $film->genre }}</span>
                <span class="inline-flex items-center rounded-full bg-cf-surface border border-cf-line px-3 py-1.5 text-xs font-semibold text-cf-muted">{{ $film->langue }}</span>
                @if ($film->prix_fespaco)
                    <span class="inline-flex items-center gap-1 rounded-full bg-cf-gold px-3 py-1.5 text-xs font-bold text-cf-gold-ink">
                        <i class="ti ti-award"></i> {{ $film->prix_fespaco }}
                    </span>
                @endif
                @if ($film->est_burkinabe)
                    <span class="inline-flex items-center rounded-full bg-cf-surface-2 px-3 py-1.5 text-xs font-bold text-cf-ink">🇧🇫 Burkinabè</span>
                @elseif ($film->est_africain)
                    <span class="inline-flex items-center rounded-full bg-cf-surface-2 px-3 py-1.5 text-xs font-bold text-cf-ink">Film africain</span>
                @endif
            </div>

            <dl class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-4 py-4 border-y border-cf-line">
                <div>
                    <dt class="text-[10.5px] uppercase tracking-wide text-cf-faint">Réalisateur</dt>
                    <dd class="font-semibold text-cf-ink mt-0.5">{{ $film->realisateur }}</dd>
                </div>
                <div>
                    <dt class="text-[10.5px] uppercase tracking-wide text-cf-faint">Pays</dt>
                    <dd class="font-semibold text-cf-ink mt-0.5">{{ $film->pays }}</dd>
                </div>
                <div>
                    <dt class="text-[10.5px] uppercase tracking-wide text-cf-faint">Année</dt>
                    <dd class="font-semibold text-cf-ink mt-0.5">{{ $film->annee }}</dd>
                </div>
                <div>
                    <dt class="text-[10.5px] uppercase tracking-wide text-cf-faint">Durée</dt>
                    <dd class="font-semibold text-cf-ink mt-0.5">{{ $film->duree_min }} min</dd>
                </div>
            </dl>

            @if ($film->synopsis)
                <div class="mt-6">
                    <h2 class="font-display font-bold text-cf-ink mb-2">Synopsis</h2>
                    <p class="text-cf-muted leading-relaxed">{{ $film->synopsis }}</p>
                </div>
            @endif

            {{-- Séances --}}
            <div class="mt-10">
                <h2 class="font-display text-lg font-bold text-cf-ink mb-4">Séances disponibles</h2>

                @if ($seances->isEmpty())
                    <p class="text-cf-muted">Aucune séance à venir pour ce film pour le moment.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($seances as $seance)
                            <div x-data="{ rappelOpen: false }" class="rounded-xl border border-cf-line bg-cf-surface p-4">
                                <div class="flex flex-wrap items-start justify-between gap-3">
                                    <div>
                                        <p class="font-semibold text-cf-ink">{{ $seance->lieu->nom }}</p>
                                        <p class="text-sm text-cf-faint">{{ $seance->lieu->adresse }}</p>
                                        <div class="mt-1.5 flex flex-wrap items-center gap-3 text-sm">
                                            <span class="flex items-center gap-1 font-display font-bold text-cf-gold">
                                                {{ $seance->date_heure->locale('fr')->translatedFormat('D d M') }}
                                                · {{ $seance->date_heure->format('H:i') }}
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-cf-surface-2 px-2 py-1 text-[11px] font-medium text-cf-muted">{{ $seance->version }}</span>
                                            <span class="text-cf-faint">{{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</span>
                                            @if ($seance->festival_id)
                                                <span class="inline-flex items-center gap-0.5 rounded-full bg-cf-gold px-2 py-0.5 text-[11px] font-bold text-cf-gold-ink"><i class="ti ti-award"></i> FESPACO</span>
                                            @endif
                                        </div>
                                    </div>
                                    <button @click="rappelOpen = !rappelOpen" type="button"
                                            class="shrink-0 inline-flex items-center gap-1.5 rounded-lg border border-cf-gold/40 text-cf-gold px-4 py-2 text-sm font-semibold hover:bg-cf-gold/10 transition">
                                        <i class="ti ti-bell"></i> Activer un rappel
                                    </button>
                                </div>

                                <form x-show="rappelOpen" x-cloak method="POST" action="{{ route('rappels.store') }}"
                                      class="mt-4 flex flex-wrap gap-2 pt-4 border-t border-cf-line">
                                    @csrf
                                    <input type="hidden" name="seance_id" value="{{ $seance->id }}">
                                    <input type="tel" name="telephone" placeholder="+226 70 00 00 00" required
                                           class="flex-1 min-w-[180px] rounded-lg bg-cf-surface-2 border-cf-line text-cf-ink placeholder:text-cf-faint text-sm focus:border-cf-gold focus:ring-cf-gold">
                                    <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2 text-sm font-semibold hover:bg-cf-gold-strong transition">
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
