@extends('layouts.admin')

@section('page-title', 'Séances')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <div class="flex gap-2">
            <a href="{{ route('admin.seances.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                <i class="ti ti-plus"></i> Séance rapide
            </a>
            <a href="{{ route('admin.seances.grille') }}"
               class="inline-flex items-center gap-2 rounded-lg border border-cf-line px-4 py-2.5 text-sm font-semibold text-cf-muted hover:bg-cf-surface-2 transition">
                <i class="ti ti-table"></i> Grille semaine
            </a>
        </div>
    </div>

    <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
        @if ($seances->isEmpty())
            <p class="p-5 text-cf-muted text-sm">Aucune séance publiée pour le moment.</p>
        @else
            {{-- Liste (mobile) --}}
            <div class="md:hidden divide-y divide-cf-line">
                @foreach ($seances as $seance)
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-3">
                            <p class="font-medium text-cf-ink">{{ $seance->film->titre }}</p>
                            <x-badge :color="$seance->active ? 'success' : 'gray'">
                                {{ $seance->active ? 'Active' : 'Annulée' }}
                            </x-badge>
                        </div>
                        <p class="text-sm text-cf-muted mt-1">{{ $seance->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</p>
                        <div class="mt-2 flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <x-tag>{{ $seance->version }}</x-tag>
                                <span class="text-cf-muted">{{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <a href="{{ route('admin.seances.edit', $seance) }}" class="text-cf-gold font-medium">Modifier</a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tableau (desktop) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-cf-surface-2 text-cf-muted text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">Film</th>
                            <th class="px-5 py-3 text-left">Date &amp; heure</th>
                            <th class="px-5 py-3 text-left">Version</th>
                            <th class="px-5 py-3 text-left">Tarif</th>
                            <th class="px-5 py-3 text-left">Statut</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cf-line">
                        @foreach ($seances as $seance)
                            <tr>
                                <td class="px-5 py-3 font-medium text-cf-ink">{{ $seance->film->titre }}</td>
                                <td class="px-5 py-3 text-cf-muted">{{ $seance->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</td>
                                <td class="px-5 py-3"><x-tag>{{ $seance->version }}</x-tag></td>
                                <td class="px-5 py-3 text-cf-muted">{{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</td>
                                <td class="px-5 py-3">
                                    <x-badge :color="$seance->active ? 'success' : 'gray'">
                                        {{ $seance->active ? 'Active' : 'Annulée' }}
                                    </x-badge>
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('admin.seances.edit', $seance) }}" class="text-cf-gold hover:text-cf-gold-strong font-medium">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-cf-line">
                {{ $seances->links() }}
            </div>
        @endif
    </div>
@endsection
