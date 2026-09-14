@extends('layouts.superadmin')

@section('page-title', 'Utilisateurs')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <a href="{{ route('superadmin.users.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
            <i class="ti ti-plus"></i> Nouveau gérant
        </a>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
        {{-- Liste (mobile) --}}
        <div class="md:hidden divide-y divide-gray-100">
            @foreach ($users as $user)
                <div class="p-4">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-medium text-gray-900">{{ $user->nom }}</p>
                        <x-badge :color="$user->active ? 'success' : 'gray'">{{ $user->active ? 'Actif' : 'Désactivé' }}</x-badge>
                    </div>
                    <p class="text-sm text-gray-500 mt-1 break-all">{{ $user->email }}</p>
                    <p class="text-sm text-gray-500">{{ $user->lieu?->nom ?? '—' }}</p>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <form method="POST" action="{{ route('superadmin.users.toggle', $user) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-gray-500 font-medium">
                                {{ $user->active ? 'Désactiver' : 'Activer' }}
                            </button>
                        </form>
                        <a href="{{ route('superadmin.users.edit', $user) }}" class="text-primary-600 font-medium">Modifier</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tableau (desktop) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Nom</th>
                        <th class="px-5 py-3 text-left">Email</th>
                        <th class="px-5 py-3 text-left">Lieu</th>
                        <th class="px-5 py-3 text-left">Statut</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $user->nom }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $user->email }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $user->lieu?->nom ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <x-badge :color="$user->active ? 'success' : 'gray'">{{ $user->active ? 'Actif' : 'Désactivé' }}</x-badge>
                            </td>
                            <td class="px-5 py-3 text-right space-x-3">
                                <form method="POST" action="{{ route('superadmin.users.toggle', $user) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-gray-700 font-medium">
                                        {{ $user->active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                <a href="{{ route('superadmin.users.edit', $user) }}" class="text-primary-600 hover:text-primary-700 font-medium">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    </div>
@endsection
