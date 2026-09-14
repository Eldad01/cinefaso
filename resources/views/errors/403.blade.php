<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accès interdit — CinéFaso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/dist/tabler-icons.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div class="text-center">
        <div class="flex justify-center mb-4">
            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-primary-50 text-primary-600 text-2xl">
                <i class="ti ti-lock"></i>
            </span>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Accès interdit</h1>
        <p class="mt-2 text-gray-500">Vous n'avez pas les droits nécessaires pour accéder à cette page.</p>
        <a href="/" class="mt-6 inline-flex items-center gap-2 rounded-lg bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-700 transition">
            Retour à l'accueil
        </a>
    </div>
</body>
</html>
