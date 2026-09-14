@extends('layouts.superadmin')

@section('page-title', 'Festivals')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <a href="{{ route('superadmin.festivals.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            <i class="ti ti-plus"></i> Nouveau festival
        </a>
    </div>

    <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
        {{-- Liste (mobile) --}}
        <div class="md:hidden divide-y divide-cf-line">
            @foreach ($festivals as $festival)
                <div class="p-4">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-medium text-cf-ink">
                            {{ $festival->nom }}{{ $festival->edition ? ' — '.$festival->edition : '' }}
                        </p>
                        <x-badge :color="$festival->actif ? 'success' : 'gray'">{{ $festival->actif ? 'Actif' : 'Inactif' }}</x-badge>
                    </div>
                    <p class="text-sm text-cf-muted mt-1">
                        {{ $festival->date_debut->format('d/m/Y') }} — {{ $festival->date_fin->format('d/m/Y') }}
                    </p>
                    <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm">
                        <a href="{{ route('superadmin.festivals.programme', $festival) }}" class="text-cf-muted font-medium">Programme</a>
                        @if ($festival->actif)
                            <form method="POST" action="{{ route('superadmin.festivals.clore', $festival) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-cf-muted font-medium">Clôturer</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('superadmin.festivals.activer', $festival) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-cf-gold font-medium">Activer</button>
                            </form>
                        @endif
                        <a href="{{ route('superadmin.festivals.edit', $festival) }}" class="text-cf-gold font-medium">Modifier</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tableau (desktop) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-cf-surface-2 text-cf-muted text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Nom</th>
                        <th class="px-5 py-3 text-left">Dates</th>
                        <th class="px-5 py-3 text-left">Statut</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cf-line">
                    @foreach ($festivals as $festival)
                        <tr>
                            <td class="px-5 py-3 font-medium text-cf-ink">
                                {{ $festival->nom }}{{ $festival->edition ? ' — '.$festival->edition : '' }}
                            </td>
                            <td class="px-5 py-3 text-cf-muted">
                                {{ $festival->date_debut->format('d/m/Y') }} — {{ $festival->date_fin->format('d/m/Y') }}
                            </td>
                            <td class="px-5 py-3">
                                <x-badge :color="$festival->actif ? 'success' : 'gray'">{{ $festival->actif ? 'Actif' : 'Inactif' }}</x-badge>
                            </td>
                            <td class="px-5 py-3 text-right space-x-3">
                                <a href="{{ route('superadmin.festivals.programme', $festival) }}" class="text-cf-muted hover:text-cf-ink font-medium">Programme</a>
                                @if ($festival->actif)
                                    <form method="POST" action="{{ route('superadmin.festivals.clore', $festival) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-cf-muted hover:text-cf-ink font-medium">Clôturer</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('superadmin.festivals.activer', $festival) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-cf-gold hover:text-cf-gold font-medium">Activer</button>
                                    </form>
                                @endif
                                <a href="{{ route('superadmin.festivals.edit', $festival) }}" class="text-cf-gold hover:text-cf-gold-strong font-medium">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-cf-line">
            {{ $festivals->links() }}
        </div>
    </div>
@endsection
