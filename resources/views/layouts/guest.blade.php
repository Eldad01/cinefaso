<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CinéFaso') }}</title>

        @include('partials.favicon')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icônes Tabler -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/dist/tabler-icons.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-cf-ink antialiased">
        <div class="min-h-screen relative overflow-hidden flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cf-bg">
            {{-- Fond vivant : aplats de couleur diffus, dans la palette de la marque --}}
            <div class="pointer-events-none absolute inset-0 overflow-hidden">
                <div class="absolute -top-28 -left-24 h-80 w-80 rounded-full opacity-50 blur-[90px]" style="background:#164E4A"></div>
                <div class="absolute top-1/4 -right-24 h-96 w-96 rounded-full opacity-40 blur-[100px]" style="background:#6B3A2E"></div>
                <div class="absolute -bottom-32 left-1/4 h-80 w-80 rounded-full opacity-40 blur-[100px]" style="background:#3B2145"></div>
                <div class="absolute bottom-0 right-1/3 h-64 w-64 rounded-full opacity-30 blur-[90px] bg-cf-gold"></div>
            </div>

            <div class="relative">
                <a href="/">
                    <img src="{{ asset('images/logo-full.webp') }}" alt="CinéFaso" class="h-32 w-auto">
                </a>
            </div>

            <div class="relative w-full sm:max-w-md mt-6 px-6 py-6 bg-cf-surface/95 backdrop-blur-sm border border-cf-line shadow-2xl overflow-hidden sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
