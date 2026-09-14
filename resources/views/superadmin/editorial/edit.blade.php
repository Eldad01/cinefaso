@extends('layouts.superadmin')

@section('page-title', 'Modifier l\'article')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl border border-cf-line bg-cf-surface p-6">
            <form method="POST" action="{{ route('superadmin.editorial.update', $article) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('superadmin.editorial._fields')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                        Enregistrer
                    </button>
                    <a href="{{ route('superadmin.editorial.index') }}" class="rounded-lg border border-cf-line px-5 py-2.5 text-sm font-semibold text-cf-muted hover:bg-cf-surface-2 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

        <form method="POST" action="{{ route('superadmin.editorial.destroy', $article) }}" class="mt-4"
              onsubmit="return confirm('Supprimer définitivement cet article ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">
                <i class="ti ti-trash"></i> Supprimer cet article
            </button>
        </form>
    </div>
@endsection
