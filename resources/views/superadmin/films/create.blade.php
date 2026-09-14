@extends('layouts.superadmin')

@section('page-title', 'Nouveau film')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl border border-cf-line bg-cf-surface p-6">
            <form method="POST" action="{{ route('superadmin.films.store') }}" enctype="multipart/form-data">
                @csrf
                @include('superadmin.films._fields')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                        Créer le film
                    </button>
                    <a href="{{ route('superadmin.films.index') }}" class="rounded-lg border border-cf-line px-5 py-2.5 text-sm font-semibold text-cf-muted hover:bg-cf-surface-2 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
