@extends('layouts.admin')

@section('page-title', 'Nouvelle séance')

@section('content')
    <div class="max-w-xl">
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-600">Tableau de bord</a>
            <i class="ti ti-chevron-right"></i>
            <span class="text-gray-900">Nouvelle séance</span>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('admin.seances.store') }}">
                @csrf
                @include('admin.seances._form')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                        Publier la séance
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
