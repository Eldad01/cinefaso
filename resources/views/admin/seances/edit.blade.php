@extends('layouts.admin')

@section('page-title', 'Modifier la séance')

@section('content')
    <div class="max-w-xl">
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('admin.seances.index') }}" class="hover:text-primary-600">Séances</a>
            <i class="ti ti-chevron-right"></i>
            <span class="text-gray-900">Modifier</span>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('admin.seances.update', $seance) }}">
                @csrf
                @method('PUT')
                @include('admin.seances._form')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                        Enregistrer
                    </button>
                    <a href="{{ route('admin.seances.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
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
