@extends('layouts.superadmin')

@section('page-title', 'Modifier le festival')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('superadmin.festivals.update', $festival) }}">
                @csrf
                @method('PUT')
                @include('superadmin.festivals._fields')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
                        Enregistrer
                    </button>
                    <a href="{{ route('superadmin.festivals.programme', $festival) }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Gérer le programme
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
