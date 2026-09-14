@extends('layouts.superadmin')

@section('page-title', 'Contenu éditorial')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <form method="GET" class="flex gap-2">
            <select name="type" onchange="this.form.submit()" class="rounded-lg border-cf-line text-sm focus:border-cf-gold focus:ring-cf-gold">
                <option value="">Tous les types</option>
                @foreach (['actualite' => 'Actualité', 'portrait' => 'Portrait', 'palmares' => 'Palmarès'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('type') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('superadmin.editorial.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-4 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            <i class="ti ti-plus"></i> Nouvel article
        </a>
    </div>

    <div class="rounded-xl border border-cf-line bg-cf-surface overflow-hidden">
        @if ($articles->isEmpty())
            <p class="p-5 text-cf-muted text-sm">Aucun article pour le moment.</p>
        @else
            {{-- Liste (mobile) --}}
            <div class="md:hidden divide-y divide-cf-line">
                @foreach ($articles as $article)
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-3">
                            <p class="font-medium text-cf-ink">{{ $article->titre }}</p>
                            <x-badge :color="$article->publie ? 'success' : 'gray'">{{ $article->publie ? 'Publié' : 'Brouillon' }}</x-badge>
                        </div>
                        <div class="mt-2 flex items-center justify-between text-sm">
                            <x-tag>{{ ucfirst($article->type) }}</x-tag>
                            <a href="{{ route('superadmin.editorial.edit', $article) }}" class="text-cf-gold font-medium">Modifier</a>
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
                            <th class="px-5 py-3 text-left">Statut</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cf-line">
                        @foreach ($articles as $article)
                            <tr>
                                <td class="px-5 py-3 font-medium text-cf-ink">{{ $article->titre }}</td>
                                <td class="px-5 py-3"><x-tag>{{ ucfirst($article->type) }}</x-tag></td>
                                <td class="px-5 py-3">
                                    <x-badge :color="$article->publie ? 'success' : 'gray'">{{ $article->publie ? 'Publié' : 'Brouillon' }}</x-badge>
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('superadmin.editorial.edit', $article) }}" class="text-cf-gold hover:text-cf-gold-strong font-medium">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-cf-line">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection
