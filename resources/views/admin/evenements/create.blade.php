@extends('layouts.admin')

@section('page-title', 'Nouvel événement')

@section('content')
    <div class="max-w-xl">
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('admin.evenements.index') }}" class="hover:text-primary-600">Événements</a>
            <i class="ti ti-chevron-right"></i>
            <span class="text-gray-900">Nouvel événement</span>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('admin.evenements.store') }}">
                @csrf
                @include('admin.evenements._form')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                        Créer l'événement
                    </button>
                    <a href="{{ route('admin.evenements.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
