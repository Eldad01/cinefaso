@extends('layouts.superadmin')

@section('page-title', 'Utilisateurs')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <a href="{{ route('superadmin.users.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            <i class="ti ti-plus"></i> Nouveau gérant
        </a>
    </div>

    <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
        {{-- Liste (mobile) --}}
        <div class="md:hidden divide-y divide-cf-line">
            @foreach ($users as $user)
                <div class="p-4">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-medium text-cf-ink">{{ $user->nom }}</p>
                        <x-badge :color="$user->active ? 'success' : 'gray'">{{ $user->active ? 'Actif' : 'Désactivé' }}</x-badge>
                    </div>
                    <p class="text-sm text-cf-muted mt-1 break-all">{{ $user->email }}</p>
                    <p class="text-sm text-cf-muted">{{ $user->lieu?->nom ?? '—' }}</p>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <form method="POST" action="{{ route('superadmin.users.toggle', $user) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-cf-muted font-medium">
                                {{ $user->active ? 'Désactiver' : 'Activer' }}
                            </button>
                        </form>
                        <a href="{{ route('superadmin.users.edit', $user) }}" class="text-cf-gold font-medium">Modifier</a>
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
                        <th class="px-5 py-3 text-left">Email</th>
                        <th class="px-5 py-3 text-left">Lieu</th>
                        <th class="px-5 py-3 text-left">Statut</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cf-line">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-5 py-3 font-medium text-cf-ink">{{ $user->nom }}</td>
                            <td class="px-5 py-3 text-cf-muted">{{ $user->email }}</td>
                            <td class="px-5 py-3 text-cf-muted">{{ $user->lieu?->nom ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <x-badge :color="$user->active ? 'success' : 'gray'">{{ $user->active ? 'Actif' : 'Désactivé' }}</x-badge>
                            </td>
                            <td class="px-5 py-3 text-right space-x-3">
                                <form method="POST" action="{{ route('superadmin.users.toggle', $user) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-cf-muted hover:text-cf-ink font-medium">
                                        {{ $user->active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                <a href="{{ route('superadmin.users.edit', $user) }}" class="text-cf-gold hover:text-cf-gold-strong font-medium">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-cf-line">
            {{ $users->links() }}
        </div>
    </div>
@endsection
