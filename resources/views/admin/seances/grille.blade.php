@extends('layouts.admin')

@section('page-title', 'Grille semaine')

@section('content')
<div class="max-w-5xl">
    <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('admin.seances.index') }}" class="hover:text-primary-600">Séances</a>
        <i class="ti ti-chevron-right"></i>
        <span class="text-gray-900">Grille semaine</span>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-6">
        <p class="text-sm text-gray-500 mb-6">
            Choisissez le lundi de la semaine à programmer, ajoutez un film par ligne, puis remplissez
            uniquement les cases des jours où il est projeté (format HH:MM). Laissez vide les jours sans séance.
        </p>

        <form method="POST" action="{{ route('admin.seances.grille.store') }}" id="grille-form">
            @csrf

            <div class="mb-6">
                <label for="semaine_du" class="block text-sm font-medium text-gray-700 mb-1">Semaine du (lundi)</label>
                <input type="date" name="semaine_du" id="semaine_du" required
                       class="rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-xs text-gray-500 uppercase">
                            <th class="text-left px-2">Film</th>
                            <th class="text-left px-2">Version</th>
                            <th class="text-left px-2">Tarif</th>
                            <th class="text-center px-1">Lun</th>
                            <th class="text-center px-1">Mar</th>
                            <th class="text-center px-1">Mer</th>
                            <th class="text-center px-1">Jeu</th>
                            <th class="text-center px-1">Ven</th>
                            <th class="text-center px-1">Sam</th>
                            <th class="text-center px-1">Dim</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="grille-rows"></tbody>
                </table>
            </div>

            <button type="button" id="add-row"
                    class="mt-2 inline-flex items-center gap-2 rounded-lg border border-primary-200 text-primary-700 px-4 py-2 text-sm font-semibold hover:bg-primary-50 transition">
                <i class="ti ti-plus"></i> Ajouter un film à la grille
            </button>

            <div class="mt-6">
                <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                    Publier tout le programme
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
        @for ($i = 0; $i < 7; $i++)
            <td class="px-1 py-1">
                <input type="time" name="__ROWNAME__[horaires][{{ $i }}]"
                       class="w-24 rounded-lg border-gray-300 text-xs focus:border-primary-500 focus:ring-primary-500">
            </td>
        @endfor
        <td class="px-1 py-1">
            <button type="button" class="remove-row text-gray-400 hover:text-red-600" aria-label="Supprimer cette ligne">
                <i class="ti ti-x"></i>
            </button>
        </td>
    </tr>
</template>

<script>
    (function () {
        var rowsContainer = document.getElementById('grille-rows');
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

        // Une première ligne par défaut pour ne pas partir d'une grille vide.
        addRow();
    })();
</script>
@endsection
