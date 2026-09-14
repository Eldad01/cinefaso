@extends('layouts.superadmin')

@section('page-title', 'Programme du festival')

@section('content')
<div class="max-w-5xl">
    <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('superadmin.festivals.index') }}" class="hover:text-primary-600">Festivals</a>
        <i class="ti ti-chevron-right"></i>
        <span class="text-gray-900">{{ $festival->nom }} — Programme</span>
    </div>

    {{-- Séances déjà publiées --}}
    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden mb-8">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Séances déjà publiées ({{ $seances->count() }})</h2>
        </div>
        @if ($seances->isEmpty())
            <p class="p-5 text-gray-500 text-sm">Aucune séance publiée pour ce festival pour le moment.</p>
        @else
            <div class="overflow-x-auto max-h-80 overflow-y-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase sticky top-0">
                        <tr>
                            <th class="px-5 py-3 text-left">Film</th>
                            <th class="px-5 py-3 text-left">Lieu</th>
                            <th class="px-5 py-3 text-left">Catégorie</th>
                            <th class="px-5 py-3 text-left">Date &amp; heure</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($seances as $seance)
                            <tr>
                                <td class="px-5 py-3 font-medium text-gray-900">{{ $seance->film->titre }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $seance->lieu->nom }}</td>
                                <td class="px-5 py-3 text-gray-600 capitalize">{{ str_replace('_', ' ', $seance->categorie) }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $seance->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Ajouter des séances --}}
    <div class="rounded-xl border border-gray-200 bg-white p-6">
        <h2 class="font-semibold text-gray-900 mb-4">Ajouter des séances au programme</h2>

        <form method="POST" action="{{ route('superadmin.festivals.programme.store', $festival) }}" id="programme-form">
            @csrf

            <div class="overflow-x-auto">
                <table class="w-full text-sm border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-xs text-gray-500 uppercase">
                            <th class="text-left px-2">Film</th>
                            <th class="text-left px-2">Lieu</th>
                            <th class="text-left px-2">Catégorie</th>
                            <th class="text-left px-2">Version</th>
                            <th class="text-left px-2">Tarif</th>
                            <th class="text-left px-2">Date &amp; heure</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="programme-rows"></tbody>
                </table>
            </div>

            <button type="button" id="add-row"
                    class="mt-2 inline-flex items-center gap-2 rounded-lg border border-primary-200 text-primary-700 px-4 py-2 text-sm font-semibold hover:bg-primary-50 transition">
                <i class="ti ti-plus"></i> Ajouter une séance
            </button>

            <div class="mt-6">
                <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                    Publier le programme
                </button>
            </div>
        </form>
    </div>
</div>

<template id="row-template">
    <tr class="align-top">
        <td class="px-2 py-1 min-w-[160px]">
            <select name="__ROWNAME__[film_id]" required class="w-full rounded-lg border-gray-300 text-xs focus:border-primary-500 focus:ring-primary-500">
                <option value="">Film…</option>
                @foreach ($films as $film)
                    <option value="{{ $film->id }}">{{ $film->titre }}</option>
                @endforeach
            </select>
        </td>
        <td class="px-2 py-1 min-w-[160px]">
            <select name="__ROWNAME__[lieu_id]" required class="w-full rounded-lg border-gray-300 text-xs focus:border-primary-500 focus:ring-primary-500">
                <option value="">Lieu…</option>
                @foreach ($lieuxParticipants as $lieu)
                    <option value="{{ $lieu->id }}">{{ $lieu->nom }}</option>
                @endforeach
            </select>
        </td>
        <td class="px-2 py-1">
            <select name="__ROWNAME__[categorie]" required class="w-full rounded-lg border-gray-300 text-xs focus:border-primary-500 focus:ring-primary-500">
                <option value="normale">Normale</option>
                <option value="competition">Compétition</option>
                <option value="hors_competition">Hors compétition</option>
                <option value="panorama">Panorama</option>
            </select>
        </td>
        <td class="px-2 py-1">
            <select name="__ROWNAME__[version]" required class="w-full rounded-lg border-gray-300 text-xs focus:border-primary-500 focus:ring-primary-500">
                @foreach (['VF', 'VO', 'VOSTFR', '3D', '3D-VF', '3D-VOSTFR'] as $version)
                    <option value="{{ $version }}">{{ $version }}</option>
                @endforeach
            </select>
        </td>
        <td class="px-2 py-1">
            <input type="number" name="__ROWNAME__[tarif_fcfa]" min="0" required placeholder="FCFA"
                   class="w-20 rounded-lg border-gray-300 text-xs focus:border-primary-500 focus:ring-primary-500">
        </td>
        <td class="px-2 py-1">
            <input type="datetime-local" name="__ROWNAME__[date_heure]" required
                   class="rounded-lg border-gray-300 text-xs focus:border-primary-500 focus:ring-primary-500">
        </td>
        <td class="px-1 py-1">
            <button type="button" class="remove-row text-gray-400 hover:text-red-600" aria-label="Supprimer cette ligne">
                <i class="ti ti-x"></i>
            </button>
        </td>
    </tr>
</template>

<script>
    (function () {
        var rowsContainer = document.getElementById('programme-rows');
        var template = document.getElementById('row-template');
        var addButton = document.getElementById('add-row');
        var rowIndex = 0;

        function addRow() {
            var html = template.innerHTML.split('__ROWNAME__').join('lignes[' + rowIndex + ']');
            var wrapper = document.createElement('tbody');
            wrapper.innerHTML = html;
            var row = wrapper.querySelector('tr');
            row.querySelector('.remove-row').addEventListener('click', function () {
                row.remove();
            });
            rowsContainer.appendChild(row);
            rowIndex++;
        }

        addButton.addEventListener('click', addRow);
        addRow();
    })();
</script>
@endsection
