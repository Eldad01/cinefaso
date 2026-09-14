@extends('layouts.superadmin')

@section('page-title', 'Modifier le film')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('superadmin.films.update', $film) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('superadmin.films._fields')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                        Enregistrer
                    </button>
                    <a href="{{ route('superadmin.films.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

        <form method="POST" action="{{ route('superadmin.films.destroy', $film) }}" class="mt-4"
              onsubmit="return confirm('Supprimer définitivement ce film ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">
                <i class="ti ti-trash"></i> Supprimer ce film
            </button>
        </form>
    </div>
@endsection
