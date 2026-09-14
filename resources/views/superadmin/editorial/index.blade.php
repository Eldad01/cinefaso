@extends('layouts.superadmin')

@section('page-title', 'Contenu éditorial')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <form method="GET" class="flex gap-2">
            <select name="type" onchange="this.form.submit()" class="rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                <option value="">Tous les types</option>
                @foreach (['actualite' => 'Actualité', 'portrait' => 'Portrait', 'palmares' => 'Palmarès'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('type') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('superadmin.editorial.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
            <i class="ti ti-plus"></i> Nouvel article
        </a>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden">
        @if ($articles->isEmpty())
            <p class="p-5 text-gray-500 text-sm">Aucun article pour le moment.</p>
        @else
            {{-- Liste (mobile) --}}
            <div class="md:hidden divide-y divide-gray-100">
                @foreach ($articles as $article)
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-3">
                            <p class="font-medium text-gray-900">{{ $article->titre }}</p>
                            <x-badge :color="$article->publie ? 'success' : 'gray'">{{ $article->publie ? 'Publié' : 'Brouillon' }}</x-badge>
                        </div>
                        <div class="mt-2 flex items-center justify-between text-sm">
                            <x-tag>{{ ucfirst($article->type) }}</x-tag>
                            <a href="{{ route('superadmin.editorial.edit', $article) }}" class="text-primary-600 font-medium">Modifier</a>
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
                            <th class="px-5 py-3 text-left">Type</th>
                            <th class="px-5 py-3 text-left">Statut</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($articles as $article)
                            <tr>
                                <td class="px-5 py-3 font-medium text-gray-900">{{ $article->titre }}</td>
                                <td class="px-5 py-3"><x-tag>{{ ucfirst($article->type) }}</x-tag></td>
                                <td class="px-5 py-3">
                                    <x-badge :color="$article->publie ? 'success' : 'gray'">{{ $article->publie ? 'Publié' : 'Brouillon' }}</x-badge>
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('superadmin.editorial.edit', $article) }}" class="text-primary-600 hover:text-primary-700 font-medium">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection
