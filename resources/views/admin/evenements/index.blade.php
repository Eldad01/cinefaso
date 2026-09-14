@extends('layouts.admin')

@section('page-title', 'Événements')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <a href="{{ route('admin.evenements.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
            <i class="ti ti-plus"></i> Nouvel événement
        </a>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
        @if ($evenements->isEmpty())
            <p class="p-5 text-gray-500 text-sm">Aucun événement pour le moment.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">Titre</th>
                            <th class="px-5 py-3 text-left">Type</th>
                            <th class="px-5 py-3 text-left">Date &amp; heure</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($evenements as $evenement)
                            <tr>
                                <td class="px-5 py-3 font-medium text-gray-900">
                                    {{ $evenement->titre }}
                                    @if ($evenement->est_fespaco)
                                        <x-badge color="secondary" class="ml-1"><i class="ti ti-award"></i></x-badge>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-gray-600">{{ str_replace('_', ' ', $evenement->type) }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $evenement->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('admin.evenements.edit', $evenement) }}" class="text-primary-600 hover:text-primary-700 font-medium">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $evenements->links() }}
            </div>
        @endif
    </div>
@endsection
