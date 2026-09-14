<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page introuvable — CinéFaso</title>
    @include('partials.favicon')
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="font-body min-h-screen flex items-center justify-center bg-cf-bg px-4">
    <div class="text-center">
        <img src="{{ asset('images/logo-lockup.webp') }}" alt="CinéFaso" class="h-10 w-auto mx-auto mb-8">
        <div class="flex justify-center mb-4">
            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-cf-surface-2 text-cf-gold font-display text-xl font-bold">
                404
            </span>
        </div>
        <h1 class="font-display text-2xl font-bold text-cf-ink">Cette page n'existe pas</h1>
        <p class="mt-2 text-cf-muted">La page que vous cherchez a peut-être été déplacée ou n'existe plus.</p>
        <a href="/" class="mt-6 inline-flex items-center gap-2 rounded-lg bg-cf-gold text-cf-gold-ink px-5 py-2.5 text-sm font-semibold hover:bg-cf-gold-strong transition">
            Retour à l'accueil
        </a>
    </div>
</body>
</html>
