@extends('layouts.superadmin')

@section('page-title', 'Nouveau film')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('superadmin.films.store') }}" enctype="multipart/form-data">
                @csrf
                @include('superadmin.films._fields')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                        Créer le film
                    </button>
                    <a href="{{ route('superadmin.films.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
