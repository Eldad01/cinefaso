@extends('layouts.superadmin')

@section('page-title', 'Cinémas')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <a href="{{ route('superadmin.lieux.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            <i class="ti ti-plus"></i> Nouveau cinéma
        </a>
    </div>

    <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
        {{-- Liste (mobile) --}}
        <div class="md:hidden divide-y divide-cf-line">
            @foreach ($lieux as $lieu)
                <div class="p-4">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-medium text-cf-ink">{{ $lieu->nom }}</p>
                        <x-badge :color="$lieu->active ? 'success' : 'gray'">{{ $lieu->active ? 'Actif' : 'Désactivé' }}</x-badge>
                    </div>
                    <p class="text-sm text-cf-muted mt-1">
                        {{ $lieu->type === 'lieu_temporaire' ? 'Temporaire' : 'Permanent' }} · {{ $lieu->seances_count }} séance{{ $lieu->seances_count > 1 ? 's' : '' }}
                    </p>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <form method="POST" action="{{ route('superadmin.lieux.toggle', $lieu) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-cf-muted font-medium">
                                {{ $lieu->active ? 'Désactiver' : 'Activer' }}
                            </button>
                        </form>
                        <a href="{{ route('superadmin.lieux.edit', $lieu) }}" class="text-cf-gold font-medium">Modifier</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tableau (desktop) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-cf-surface-2 text-cf-muted text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Nom</th>
                        <th class="px-5 py-3 text-left">Type</th>
                        <th class="px-5 py-3 text-left">Séances</th>
                        <th class="px-5 py-3 text-left">Statut</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cf-line">
                    @foreach ($lieux as $lieu)
                        <tr>
                            <td class="px-5 py-3 font-medium text-cf-ink">{{ $lieu->nom }}</td>
                            <td class="px-5 py-3 text-cf-muted">{{ $lieu->type === 'lieu_temporaire' ? 'Temporaire' : 'Permanent' }}</td>
                            <td class="px-5 py-3 text-cf-muted">{{ $lieu->seances_count }}</td>
                            <td class="px-5 py-3">
                                <x-badge :color="$lieu->active ? 'success' : 'gray'">{{ $lieu->active ? 'Actif' : 'Désactivé' }}</x-badge>
                            </td>
                            <td class="px-5 py-3 text-right space-x-3">
                                <form method="POST" action="{{ route('superadmin.lieux.toggle', $lieu) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-cf-muted hover:text-cf-ink font-medium">
                                        {{ $lieu->active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                <a href="{{ route('superadmin.lieux.edit', $lieu) }}" class="text-cf-gold hover:text-cf-gold-strong font-medium">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-cf-line">
            {{ $lieux->links() }}
        </div>
    </div>
@endsection
