<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accès interdit — CinéFaso</title>
    @include('partials.favicon')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/dist/tabler-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="font-body min-h-screen flex items-center justify-center bg-cf-bg px-4">
    <div class="text-center">
        <img src="{{ asset('images/logo-lockup.webp') }}" alt="CinéFaso" class="h-10 w-auto mx-auto mb-8">
        <div class="flex justify-center mb-4">
            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-cf-surface-2 text-cf-gold text-2xl">
                <i class="ti ti-lock"></i>
            </span>
        </div>
        <h1 class="font-display text-2xl font-bold text-cf-ink">Accès interdit</h1>
        <p class="mt-2 text-cf-muted">Vous n'avez pas les droits nécessaires pour accéder à cette page.</p>
        <a href="/" class="mt-6 inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            Retour à l'accueil
        </a>
    </div>
</body>
</html>
