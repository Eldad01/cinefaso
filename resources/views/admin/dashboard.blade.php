@extends('layouts.admin')

@section('page-title', 'Tableau de bord')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <p class="text-gray-500">{{ $lieu->nom }}</p>
        <a href="{{ route('admin.seances.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
            <i class="ti ti-plus"></i> Ajouter une séance
        </a>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Séances cette semaine</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $seancesCetteSemaine }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Films différents</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $filmsDifferents }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Rappels activés</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $rappelsActifs }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs text-gray-400 uppercase font-medium">Vues des films à l'affiche</p>
            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $vuesFilmsAffiche }}</p>
        </div>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-900">Prochaines séances</h2>
            <a href="{{ route('admin.seances.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">
                Voir toutes <i class="ti ti-arrow-right"></i>
            </a>
        </div>

        @if ($prochainesSeances->isEmpty())
            <p class="p-5 text-gray-500 text-sm">Aucune séance à venir. Ajoutez-en une pour commencer.</p>
        @else
            {{-- Liste (mobile) --}}
            <div class="md:hidden divide-y divide-gray-100">
                @foreach ($prochainesSeances as $seance)
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-3">
                            <p class="font-medium text-gray-900">{{ $seance->film->titre }}</p>
                            <x-badge :color="$seance->active ? 'success' : 'gray'">
                                {{ $seance->active ? 'Active' : 'Annulée' }}
                            </x-badge>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $seance->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</p>
                        <div class="mt-2 flex items-center justify-between text-sm">
                            <x-tag>{{ $seance->version }}</x-tag>
                            <a href="{{ route('admin.seances.edit', $seance) }}" class="text-primary-600 font-medium">Modifier</a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tableau (desktop) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">Film</th>
                            <th class="px-5 py-3 text-left">Date &amp; heure</th>
                            <th class="px-5 py-3 text-left">Version</th>
                            <th class="px-5 py-3 text-left">Statut</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($prochainesSeances as $seance)
                            <tr>
                                <td class="px-5 py-3 font-medium text-gray-900">{{ $seance->film->titre }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $seance->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</td>
                                <td class="px-5 py-3"><x-tag>{{ $seance->version }}</x-tag></td>
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
        @endif
    </div>
@endsection
