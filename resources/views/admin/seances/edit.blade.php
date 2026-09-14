@extends('layouts.admin')

@section('page-title', 'Modifier la séance')

@section('content')
    <div class="max-w-xl">
        <div class="mb-4 flex items-center gap-2 text-sm text-cf-muted">
            <a href="{{ route('admin.seances.index') }}" class="hover:text-cf-gold">Séances</a>
            <i class="ti ti-chevron-right"></i>
            <span class="text-cf-ink">Modifier</span>
        </div>

        <div class="rounded-xl border border-cf-line bg-cf-surface p-6">
            <form method="POST" action="{{ route('admin.seances.update', $seance) }}">
                @csrf
                @method('PUT')
                @include('admin.seances._form')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                        Enregistrer
                    </button>
                    <a href="{{ route('admin.seances.index') }}" class="rounded-lg border border-cf-line px-5 py-2.5 text-sm font-semibold text-cf-muted hover:bg-cf-surface-2 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

        <form method="POST" action="{{ route('admin.seances.destroy', $seance) }}" class="mt-4"
              onsubmit="return confirm('Annuler définitivement cette séance ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">
                <i class="ti ti-trash"></i> Annuler cette séance
            </button>
        </form>
    </div>
@endsection
