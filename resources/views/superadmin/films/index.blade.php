@extends('layouts.superadmin')

@section('page-title', 'Films')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <form method="GET" class="flex-1 min-w-[180px] max-w-xs">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un film…"
                   class="w-full rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
        </form>
        <a href="{{ route('superadmin.films.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
            <i class="ti ti-plus"></i> Nouveau film
        </a>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
        {{-- Liste (mobile) --}}
        <div class="md:hidden divide-y divide-gray-100">
            @foreach ($films as $film)
                <div class="p-4">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-medium text-gray-900">
                            {{ $film->titre }}
                            @if ($film->est_burkinabe)
                                <x-badge color="primary">BF</x-badge>
                            @endif
                        </p>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">{{ $film->realisateur }} · {{ $film->annee }} · {{ $film->genre }}</p>
                    <div class="mt-2 text-right text-sm">
                        <a href="{{ route('superadmin.films.edit', $film) }}" class="text-primary-600 font-medium">Modifier</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tableau (desktop) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Titre</th>
                        <th class="px-5 py-3 text-left">Réalisateur</th>
                        <th class="px-5 py-3 text-left">Année</th>
                        <th class="px-5 py-3 text-left">Genre</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($films as $film)
                        <tr>
                            <td class="px-5 py-3 font-medium text-gray-900">
                                {{ $film->titre }}
                                @if ($film->est_burkinabe)
                                    <x-badge color="primary" class="ml-1">BF</x-badge>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $film->realisateur }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $film->annee }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $film->genre }}</td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('superadmin.films.edit', $film) }}" class="text-primary-600 hover:text-primary-700 font-medium">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $films->links() }}
        </div>
    </div>
@endsection
