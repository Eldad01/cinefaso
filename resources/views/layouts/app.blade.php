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
    <body class="font-body antialiased bg-cf-bg text-cf-ink" x-data="{ mobileNavOpen: false }">

        @php
            $navLinks = [
                ['label' => 'Accueil', 'route' => 'home', 'fallback' => '/', 'match' => 'home'],
                ['label' => 'Ce soir', 'route' => 'ce-soir', 'match' => 'ce-soir'],
                ['label' => 'Les lieux', 'route' => 'lieux.index', 'match' => 'lieux.*'],
                ['label' => 'Découvrir', 'route' => 'decouvrir', 'match' => 'decouvrir'],
                ['label' => 'Agenda', 'route' => 'agenda', 'match' => 'agenda'],
            ];
        @endphp

        {{-- Bandeau festival --}}
        @isset($festivalActif)
            <div class="bg-cf-gold text-cf-gold-ink text-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex flex-wrap items-center justify-center gap-x-3 gap-y-1 text-center">
                    <i class="ti ti-star-filled"></i>
                    <span class="font-semibold">{{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}</span>
                    <span class="hidden sm:inline">
                        du {{ $festivalActif->date_debut->locale('fr')->translatedFormat('d M') }}
                        au {{ $festivalActif->date_fin->locale('fr')->translatedFormat('d M Y') }}
                    </span>
                    <a href="{{ Route::has('festival.actif') ? route('festival.actif') : '#' }}" class="underline underline-offset-2 font-semibold hover:opacity-80">
                        Voir le programme
                    </a>
                </div>
            </div>
        @endisset

        <header class="sticky top-0 z-40 bg-cf-bg/90 backdrop-blur-md border-b border-cf-line">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <a href="{{ Route::has('home') ? route('home') : '/' }}" class="flex items-center gap-2 shrink-0">
                        <img src="{{ asset('images/logo-lockup.webp') }}" alt="CinéFaso" class="h-11 w-auto">
                    </a>

                    <nav class="hidden md:flex items-center gap-6">
                        @foreach ($navLinks as $link)
                            @php $href = Route::has($link['route']) ? route($link['route']) : ($link['fallback'] ?? '#'); @endphp
                            <a href="{{ $href }}"
                               class="text-sm font-medium transition {{ Route::has($link['route']) && request()->routeIs($link['match']) ? 'text-cf-gold' : 'text-cf-muted hover:text-cf-ink' }}">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </nav>

                    <div class="hidden md:flex items-center gap-3">
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

                    <button @click="mobileNavOpen = !mobileNavOpen" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-cf-muted hover:bg-cf-surface" aria-label="Ouvrir le menu">
                        <i class="ti text-2xl" :class="mobileNavOpen ? 'ti-x' : 'ti-menu-2'"></i>
                    </button>
                </div>
            </div>

            {{-- Menu mobile (auth uniquement — la navigation principale est en barre basse) --}}
            <div x-show="mobileNavOpen" x-cloak @click.outside="mobileNavOpen = false" class="md:hidden border-t border-cf-line bg-cf-bg">
                <nav class="px-4 py-3">
                    @auth
                        <a href="{{ route(auth()->user()->dashboardRoute()) }}" class="block rounded-md px-3 py-2 text-base font-medium text-cf-gold">
                            <i class="ti ti-layout-dashboard"></i> Mon espace
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-cf-gold">
                            <i class="ti ti-door"></i> Espace salle
                        </a>
                    @endauth
                </nav>
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
