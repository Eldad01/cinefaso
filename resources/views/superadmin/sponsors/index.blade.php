@extends('layouts.superadmin')

@section('page-title', 'Sponsors')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <p class="text-sm text-cf-muted max-w-md">Les sponsors actifs s'affichent sur le programme hebdomadaire de chaque cinéma, dans l'ordre choisi ci-dessous.</p>
        <a href="{{ route('superadmin.sponsors.create') }}"
           class="shrink-0 inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            <i class="ti ti-plus"></i> Nouveau sponsor
        </a>
    </div>

    <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
        @if ($sponsors->isEmpty())
            <p class="p-5 text-cf-muted text-sm">Aucun sponsor pour le moment.</p>
        @else
            {{-- Liste (mobile) --}}
            <div class="md:hidden divide-y divide-cf-line">
                @foreach ($sponsors as $sponsor)
                    <div class="p-4 flex items-center gap-3">
                        <div class="h-12 w-12 shrink-0 rounded-full bg-white/95 p-2 flex items-center justify-center">
                            @if ($sponsor->logo)
                                <img src="{{ Storage::url($sponsor->logo) }}" alt="{{ $sponsor->nom }}" class="max-h-full max-w-full object-contain">
                            @else
                                <span class="text-xs font-bold text-cf-bg">{{ Str::substr($sponsor->nom, 0, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3">
                                <p class="font-medium text-cf-ink truncate">{{ $sponsor->nom }}</p>
                                <x-badge :color="$sponsor->actif ? 'success' : 'gray'">{{ $sponsor->actif ? 'Actif' : 'Masqué' }}</x-badge>
                            </div>
                            <div class="mt-2 flex items-center justify-between text-sm">
                                <form method="POST" action="{{ route('superadmin.sponsors.toggle', $sponsor) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-cf-muted font-medium">
                                        {{ $sponsor->actif ? 'Masquer' : 'Afficher' }}
                                    </button>
                                </form>
                                <a href="{{ route('superadmin.sponsors.edit', $sponsor) }}" class="text-cf-gold font-medium">Modifier</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tableau (desktop) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-cf-surface-2 text-cf-muted text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">Logo</th>
                            <th class="px-5 py-3 text-left">Nom</th>
                            <th class="px-5 py-3 text-left">Ordre</th>
                            <th class="px-5 py-3 text-left">Statut</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cf-line">
                        @foreach ($sponsors as $sponsor)
                            <tr>
                                <td class="px-5 py-3">
                                    <div class="h-10 w-10 rounded-full bg-white/95 p-1.5 flex items-center justify-center">
                                        @if ($sponsor->logo)
                                            <img src="{{ Storage::url($sponsor->logo) }}" alt="{{ $sponsor->nom }}" class="max-h-full max-w-full object-contain">
                                        @else
                                            <span class="text-[10px] font-bold text-cf-bg">{{ Str::substr($sponsor->nom, 0, 2) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 py-3 font-medium text-cf-ink">
                                    {{ $sponsor->nom }}
                                    @if ($sponsor->site_web)
                                        <a href="{{ $sponsor->site_web }}" target="_blank" rel="noopener" class="ml-1 text-cf-faint hover:text-cf-gold"><i class="ti ti-external-link"></i></a>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-cf-muted">{{ $sponsor->ordre }}</td>
                                <td class="px-5 py-3">
                                    <x-badge :color="$sponsor->actif ? 'success' : 'gray'">{{ $sponsor->actif ? 'Actif' : 'Masqué' }}</x-badge>
                                </td>
                                <td class="px-5 py-3 text-right space-x-3">
                                    <form method="POST" action="{{ route('superadmin.sponsors.toggle', $sponsor) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-cf-muted hover:text-cf-ink font-medium">
                                            {{ $sponsor->actif ? 'Masquer' : 'Afficher' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('superadmin.sponsors.edit', $sponsor) }}" class="text-cf-gold hover:text-cf-gold-strong font-medium">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-cf-line">
                {{ $sponsors->links() }}
            </div>
        @endif
    </div>
@endsection
