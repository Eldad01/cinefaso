@extends('layouts.superadmin')

@section('page-title', 'Modifier le festival')

@section('content')
    <div class="max-w-2xl">
        <div class="rounded-xl border border-cf-line bg-cf-surface p-6">
            <form method="POST" action="{{ route('superadmin.festivals.update', $festival) }}">
                @csrf
                @method('PUT')
                @include('superadmin.festivals._fields')

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
                        Enregistrer
                    </button>
                    <a href="{{ route('superadmin.festivals.programme', $festival) }}" class="rounded-lg border border-cf-line px-5 py-2.5 text-sm font-semibold text-cf-muted hover:bg-cf-surface-2 transition">
                        Gérer le programme
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
