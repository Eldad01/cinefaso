@extends('layouts.superadmin')

@section('page-title', 'Lieux')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <a href="{{ route('superadmin.lieux.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
            <i class="ti ti-plus"></i> Nouveau lieu
        </a>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Nom</th>
                        <th class="px-5 py-3 text-left">Type</th>
                        <th class="px-5 py-3 text-left">Séances</th>
                        <th class="px-5 py-3 text-left">Statut</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($lieux as $lieu)
                        <tr>
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $lieu->nom }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $lieu->type === 'lieu_temporaire' ? 'Temporaire' : 'Permanent' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $lieu->seances_count }}</td>
                            <td class="px-5 py-3">
                                <x-badge :color="$lieu->active ? 'success' : 'gray'">{{ $lieu->active ? 'Actif' : 'Désactivé' }}</x-badge>
                            </td>
                            <td class="px-5 py-3 text-right space-x-3">
                                <form method="POST" action="{{ route('superadmin.lieux.toggle', $lieu) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-gray-700 font-medium">
                                        {{ $lieu->active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                <a href="{{ route('superadmin.lieux.edit', $lieu) }}" class="text-primary-600 hover:text-primary-700 font-medium">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $lieux->links() }}
        </div>
    </div>
@endsection
