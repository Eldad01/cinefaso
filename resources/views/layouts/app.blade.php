<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#141110">

        <title>@yield('title', config('app.name', 'CinéFaso')) — CinéFaso</title>

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
    <body class="font-body antialiased bg-cf-bg text-cf-ink">

        @php
            $navLinks = [
                ['label' => 'Accueil', 'route' => 'home', 'fallback' => '/', 'match' => 'home'],
                ['label' => 'Ce soir', 'route' => 'ce-soir', 'match' => 'ce-soir'],
                ['label' => 'Les lieux', 'route' => 'lieux.index', 'match' => 'lieux.*'],
                ['label' => 'Découvrir', 'route' => 'decouvrir', 'match' => 'decouvrir'],
                ['label' => 'Agenda', 'route' => 'agenda', 'match' => 'agenda'],
            ];
        @endphp

        <header class="sticky top-0 z-40 bg-cf-bg/90 backdrop-blur-md border-b border-cf-line">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <a href="{{ Route::has('home') ? route('home') : '/' }}" class="flex items-center gap-2 shrink-0">
                        <img src="{{ asset('images/logo-lockup.webp') }}" alt="CinéFaso" class="h-11 w-auto">
                    </a>

                    <div class="hidden md:flex items-center gap-6">
                        <nav class="flex items-center gap-6">
                            @foreach ($navLinks as $link)
                                @php $href = Route::has($link['route']) ? route($link['route']) : ($link['fallback'] ?? '#'); @endphp
                                <a href="{{ $href }}"
                                   class="text-sm font-medium transition {{ Route::has($link['route']) && request()->routeIs($link['match']) ? 'text-cf-gold' : 'text-cf-muted hover:text-cf-ink' }}">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </nav>

                        @isset($festivalActif)
                            <a href="{{ Route::has('festival.actif') ? route('festival.actif') : '#' }}"
                               class="inline-flex items-center gap-2 whitespace-nowrap rounded-full border border-cf-gold/30 bg-cf-gold/10 pl-2.5 pr-3.5 py-1.5 text-xs font-semibold text-cf-gold hover:bg-cf-gold/20 transition">
                                <span class="relative flex h-1.5 w-1.5 shrink-0">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-cf-gold opacity-75"></span>
                                    <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-cf-gold"></span>
                                </span>
                                {{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}
                            </a>
                        @endisset

                        @auth
                            <a href="{{ route(auth()->user()->dashboardRoute()) }}"
                               class="inline-flex items-center gap-1.5 rounded-lg bg-cf-gold px-4 py-2 text-sm font-semibold text-cf-gold-ink hover:bg-cf-gold-strong transition">
                                <i class="ti ti-layout-dashboard"></i> Mon espace
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-1.5 rounded-lg bg-cf-surface-2 border border-cf-line px-4 py-2 text-sm font-semibold text-cf-ink hover:border-cf-gold/50 transition">
                                <i class="ti ti-door"></i> Espace salle
                            </a>
                        @endauth
                    </div>

                    <div class="flex items-center gap-2 md:hidden">
                        @isset($festivalActif)
                            <a href="{{ Route::has('festival.actif') ? route('festival.actif') : '#' }}"
                               class="relative flex h-10 w-10 items-center justify-center rounded-full border border-cf-gold/30 bg-cf-gold/10 text-cf-gold"
                               aria-label="Festival en cours : {{ $festivalActif->nom }}">
                                <i class="ti ti-star-filled text-base"></i>
                                <span class="absolute top-1.5 right-1.5 flex h-1.5 w-1.5">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-cf-gold opacity-75"></span>
                                    <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-cf-gold"></span>
                                </span>
                            </a>
                        @endisset

                        @auth
                            <a href="{{ route(auth()->user()->dashboardRoute()) }}"
                               class="flex h-10 w-10 items-center justify-center rounded-full bg-cf-gold text-cf-gold-ink"
                               aria-label="Mon espace">
                                <i class="ti ti-layout-dashboard text-base"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="flex h-10 w-10 items-center justify-center rounded-full bg-cf-surface-2 border border-cf-line text-cf-ink"
                               aria-label="Espace salle — connexion">
                                <i class="ti ti-door text-base"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <main class="pb-28 md:pb-0">
            @yield('content')
        </main>

        <footer class="hidden md:block mt-16 border-t border-cf-line bg-cf-bg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <img src="{{ asset('images/logo-lockup.webp') }}" alt="CinéFaso" class="h-8 w-auto">
                    <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm text-cf-muted">
                        @foreach ($navLinks as $link)
                            @php $href = Route::has($link['route']) ? route($link['route']) : ($link['fallback'] ?? '#'); @endphp
                            <a href="{{ $href }}" class="hover:text-cf-gold">{{ $link['label'] }}</a>
                        @endforeach
                    </nav>
                </div>
                <p class="mt-6 text-center sm:text-left text-xs text-cf-faint">
                    &copy; {{ now()->year }} CinéFaso — La capitale du cinéma africain mérite une plateforme à sa hauteur. Ouagadougou, Burkina Faso.
                </p>
            </div>
        </footer>

        @include('partials.bottom-nav', ['navLinks' => $navLinks])
    </body>
</html>
