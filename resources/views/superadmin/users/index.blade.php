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
        <div class="overflow-x-auto">
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
