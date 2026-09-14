@extends('layouts.admin')

@section('page-title', 'Nouvelle séance')

@section('content')
    <div class="max-w-xl">
        <div class="mb-4 flex items-center gap-2 text-sm text-cf-muted">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-cf-gold">Tableau de bord</a>
            <i class="ti ti-chevron-right"></i>
            <span class="text-cf-ink">Nouvelle séance</span>
        </div>

        <div class="rounded-xl border border-cf-line bg-cf-surface p-6">
            <form method="POST" action="{{ route('admin.seances.store') }}">
                @csrf
                @include('admin.seances._form')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                        Publier la séance
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-cf-line px-5 py-2.5 text-sm font-semibold text-cf-muted hover:bg-cf-surface-2 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
