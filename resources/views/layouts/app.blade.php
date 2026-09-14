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
    <body class="font-body antialiased bg-cf-bg text-cf-ink" x-data="{ accountMenuOpen: false }">

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
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
                                Mon espace
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-1.5 rounded-lg bg-cf-gold px-4 py-2 text-sm font-semibold text-cf-gold-ink hover:bg-cf-gold-strong transition">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/></svg>
                                Espace salle
                            </a>
                        @endauth
                    </div>

                    <div class="flex items-center gap-2 md:hidden">
                        @isset($festivalActif)
                            <a href="{{ Route::has('festival.actif') ? route('festival.actif') : '#' }}"
                               class="flex items-center gap-1.5 rounded-full border border-cf-gold/40 bg-cf-gold/10 px-2.5 py-2 text-xs font-bold text-cf-gold">
                                <span class="relative flex h-1.5 w-1.5 shrink-0">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-cf-gold opacity-75"></span>
                                    <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-cf-gold"></span>
                                </span>
                                FESPACO
                            </a>
                        @endisset

                        @auth
                            <button @click="accountMenuOpen = !accountMenuOpen"
                                    class="flex items-center gap-2 rounded-full bg-cf-gold pl-3 pr-3.5 py-2 text-sm font-bold text-cf-gold-ink shadow-lg shadow-black/30"
                                    aria-label="Menu du compte">
                                <svg width="18" height="18" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                                    <path :class="{'hidden': accountMenuOpen, 'inline-flex': !accountMenuOpen}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': !accountMenuOpen, 'inline-flex': accountMenuOpen}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Mon compte
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                               class="flex items-center gap-2 rounded-full bg-cf-gold pl-3 pr-3.5 py-2 text-sm font-bold text-cf-gold-ink shadow-lg shadow-black/30">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/>
                                </svg>
                                Connexion
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            @auth
                {{-- Menu compte mobile : accès tableau de bord / profil / déconnexion --}}
                <div x-show="accountMenuOpen" x-cloak @click.outside="accountMenuOpen = false" class="md:hidden border-t border-cf-line bg-cf-bg">
                    <div class="px-4 py-3 space-y-1">
                        <a href="{{ route(auth()->user()->dashboardRoute()) }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-cf-ink hover:bg-cf-surface-2 transition">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-cf-gold/15 text-cf-gold shrink-0">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
                            </span>
                            Tableau de bord
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-cf-ink hover:bg-cf-surface-2 transition">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-cf-gold/15 text-cf-gold shrink-0">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-7 8-7s8 3 8 7"/></svg>
                            </span>
                            Mon profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-400 hover:bg-red-500/10 transition">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-red-500/10 text-red-400 shrink-0">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                                </span>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
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
