@extends('layouts.admin')

@section('page-title', 'Séances')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <div class="flex gap-2">
            <a href="{{ route('admin.seances.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                <i class="ti ti-plus"></i> Séance rapide
            </a>
            <a href="{{ route('admin.seances.grille') }}"
               class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                <i class="ti ti-table"></i> Grille semaine
            </a>
        </div>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
        @if ($seances->isEmpty())
            <p class="p-5 text-gray-500 text-sm">Aucune séance publiée pour le moment.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">Film</th>
                            <th class="px-5 py-3 text-left">Date &amp; heure</th>
                            <th class="px-5 py-3 text-left">Version</th>
                            <th class="px-5 py-3 text-left">Tarif</th>
                            <th class="px-5 py-3 text-left">Statut</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($seances as $seance)
                            <tr>
                                <td class="px-5 py-3 font-medium text-gray-900">{{ $seance->film->titre }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $seance->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</td>
                                <td class="px-5 py-3"><x-tag>{{ $seance->version }}</x-tag></td>
                                <td class="px-5 py-3 text-gray-600">{{ number_format($seance->tarif_fcfa, 0, ',', ' ') }} FCFA</td>
                                <td class="px-5 py-3">
                                    <x-badge :color="$seance->active ? 'success' : 'gray'">
                                        {{ $seance->active ? 'Active' : 'Annulée' }}
                                    </x-badge>
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('admin.seances.edit', $seance) }}" class="text-primary-600 hover:text-primary-700 font-medium">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $seances->links() }}
            </div>
        @endif
    </div>
@endsection
