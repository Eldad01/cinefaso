@extends('layouts.admin')

@section('page-title', 'Événements')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <a href="{{ route('admin.evenements.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            <i class="ti ti-plus"></i> Nouvel événement
        </a>
    </div>

    <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
        @if ($evenements->isEmpty())
            <p class="p-5 text-cf-muted text-sm">Aucun événement pour le moment.</p>
        @else
            {{-- Liste (mobile) --}}
            <div class="md:hidden divide-y divide-cf-line">
                @foreach ($evenements as $evenement)
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-3">
                            <p class="font-medium text-cf-ink">{{ $evenement->titre }}</p>
                            @if ($evenement->est_fespaco)
                                <x-badge color="secondary"><i class="ti ti-award"></i></x-badge>
                            @endif
                        </div>
                        <p class="text-sm text-cf-muted mt-1 capitalize">{{ str_replace('_', ' ', $evenement->type) }}</p>
                        <div class="mt-2 flex items-center justify-between text-sm">
                            <span class="text-cf-muted">{{ $evenement->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</span>
                            <a href="{{ route('admin.evenements.edit', $evenement) }}" class="text-cf-gold font-medium">Modifier</a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tableau (desktop) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-cf-surface-2 text-cf-muted text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">Titre</th>
                            <th class="px-5 py-3 text-left">Type</th>
                            <th class="px-5 py-3 text-left">Date &amp; heure</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cf-line">
                        @foreach ($evenements as $evenement)
                            <tr>
                                <td class="px-5 py-3 font-medium text-cf-ink">
                                    {{ $evenement->titre }}
                                    @if ($evenement->est_fespaco)
                                        <x-badge color="secondary" class="ml-1"><i class="ti ti-award"></i></x-badge>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-cf-muted">{{ str_replace('_', ' ', $evenement->type) }}</td>
                                <td class="px-5 py-3 text-cf-muted">{{ $evenement->date_heure->locale('fr')->translatedFormat('D d M · H:i') }}</td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('admin.evenements.edit', $evenement) }}" class="text-cf-gold hover:text-cf-gold-strong font-medium">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-cf-line">
                {{ $evenements->links() }}
            </div>
        @endif
    </div>
@endsection
