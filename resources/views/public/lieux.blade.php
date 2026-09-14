@extends('layouts.app')

@section('title', 'Les lieux')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <x-section-title title="Les lieux" subtitle="Cinémas et salles partenaires à Ouagadougou" />

    @if ($lieux->isEmpty())
        <p class="text-cf-muted">Aucun lieu disponible pour le moment.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ($lieux as $lieu)
                <x-card-lieu :lieu="$lieu" :ouvert-ce-soir="$lieu->seances_count > 0" :films-count="$lieu->films_du_soir_count" />
            @endforeach
        </div>
    @endif
</div>
@endsection
