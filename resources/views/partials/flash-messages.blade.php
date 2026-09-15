@php
    $statusMessages = [
        'seance-creee' => 'Séance créée avec succès.',
        'seance-modifiee' => 'Séance modifiée avec succès.',
        'seance-annulee' => 'Séance annulée.',
        'evenement-cree' => 'Événement créé avec succès.',
        'evenement-modifie' => 'Événement modifié avec succès.',
        'evenement-supprime' => 'Événement supprimé.',
        'lieu-mis-a-jour' => 'Informations du cinéma mises à jour.',
        'lieu-cree' => 'Cinéma créé avec succès, compte gérant associé créé.',
        'lieu-modifie' => 'Cinéma modifié avec succès.',
        'lieu-archive' => 'Cinéma désactivé.',
        'lieu-active' => 'Cinéma réactivé.',
        'lieu-desactive' => 'Cinéma désactivé.',
        'film-cree' => 'Film créé avec succès.',
        'film-modifie' => 'Film modifié avec succès.',
        'film-supprime' => 'Film supprimé.',
        'user-cree' => 'Compte gérant créé avec succès.',
        'user-modifie' => 'Compte modifié avec succès.',
        'user-active' => 'Compte réactivé.',
        'user-desactive' => 'Compte désactivé.',
        'festival-cree' => 'Festival créé avec succès.',
        'festival-modifie' => 'Festival modifié avec succès.',
        'festival-active' => 'Festival activé — il est maintenant affiché sur le site.',
        'festival-clos' => 'Festival clôturé.',
        'programme-publie' => 'Programme du festival publié avec succès.',
        'article-cree' => 'Article créé avec succès.',
        'article-modifie' => 'Article modifié avec succès.',
        'article-supprime' => 'Article supprimé.',
    ];

    $status = session('status');
    $flashMessage = null;

    if ($status && str_starts_with($status, 'grille-publiee:')) {
        $count = (int) str_replace('grille-publiee:', '', $status);
        $flashMessage = $count.' séance'.($count > 1 ? 's' : '').' créée'.($count > 1 ? 's' : '').' avec succès.';
    } elseif ($status) {
        $flashMessage = $statusMessages[$status] ?? null;
    }
@endphp

@if ($flashMessage)
    <x-alert type="success" class="mb-4">{{ $flashMessage }}</x-alert>
@endif

@if ($errors->any())
    <x-alert type="error" class="mb-4">
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif
