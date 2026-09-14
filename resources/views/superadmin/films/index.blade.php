@extends('layouts.superadmin')

@section('page-title', 'Films')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <form method="GET" class="flex-1 min-w-[180px] max-w-xs">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un film…"
                   class="w-full rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
        </form>
        <a href="{{ route('superadmin.films.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            <i class="ti ti-plus"></i> Nouveau film
        </a>
    </div>

    <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
        {{-- Liste (mobile) --}}
        <div class="md:hidden divide-y divide-cf-line">
            @foreach ($films as $film)
                <div class="p-4">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-medium text-cf-ink">
                            {{ $film->titre }}
                            @if ($film->est_burkinabe)
                                <x-badge color="primary">BF</x-badge>
                            @endif
                        </p>
                    </div>
                    <p class="text-sm text-cf-muted mt-1">{{ $film->realisateur }} · {{ $film->annee }} · {{ $film->genre }}</p>
                    <div class="mt-2 text-right text-sm">
                        <a href="{{ route('superadmin.films.edit', $film) }}" class="text-cf-gold font-medium">Modifier</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tableau (desktop) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-cf-surface-2 text-cf-muted text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Titre</th>
                        <th class="px-5 py-3 text-left">Réalisateur</th>
                        <th class="px-5 py-3 text-left">Année</th>
                        <th class="px-5 py-3 text-left">Genre</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cf-line">
                    @foreach ($films as $film)
                        <tr>
                            <td class="px-5 py-3 font-medium text-cf-ink">
                                {{ $film->titre }}
                                @if ($film->est_burkinabe)
                                    <x-badge color="primary" class="ml-1">BF</x-badge>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-cf-muted">{{ $film->realisateur }}</td>
                            <td class="px-5 py-3 text-cf-muted">{{ $film->annee }}</td>
                            <td class="px-5 py-3 text-cf-muted">{{ $film->genre }}</td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('superadmin.films.edit', $film) }}" class="text-cf-gold hover:text-cf-gold-strong font-medium">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-cf-line">
            {{ $films->links() }}
        </div>
    </div>
@endsection
