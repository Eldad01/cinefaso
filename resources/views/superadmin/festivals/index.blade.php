@extends('layouts.superadmin')

@section('page-title', 'Festivals')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <a href="{{ route('superadmin.festivals.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
            <i class="ti ti-plus"></i> Nouveau festival
        </a>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Nom</th>
                        <th class="px-5 py-3 text-left">Dates</th>
                        <th class="px-5 py-3 text-left">Statut</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($festivals as $festival)
                        <tr>
                            <td class="px-5 py-3 font-medium text-gray-900">
                                {{ $festival->nom }}{{ $festival->edition ? ' — '.$festival->edition : '' }}
                            </td>
                            <td class="px-5 py-3 text-gray-600">
                                {{ $festival->date_debut->format('d/m/Y') }} — {{ $festival->date_fin->format('d/m/Y') }}
                            </td>
                            <td class="px-5 py-3">
                                <x-badge :color="$festival->actif ? 'success' : 'gray'">{{ $festival->actif ? 'Actif' : 'Inactif' }}</x-badge>
                            </td>
                            <td class="px-5 py-3 text-right space-x-3">
                                <a href="{{ route('superadmin.festivals.programme', $festival) }}" class="text-gray-500 hover:text-gray-700 font-medium">Programme</a>
                                @if ($festival->actif)
                                    <form method="POST" action="{{ route('superadmin.festivals.clore', $festival) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-gray-500 hover:text-gray-700 font-medium">Clôturer</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('superadmin.festivals.activer', $festival) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-secondary-600 hover:text-secondary-700 font-medium">Activer</button>
                                    </form>
                                @endif
                                <a href="{{ route('superadmin.festivals.edit', $festival) }}" class="text-primary-600 hover:text-primary-700 font-medium">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $festivals->links() }}
        </div>
    </div>
@endsection
