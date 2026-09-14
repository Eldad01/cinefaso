<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'CinéFaso')) — CinéFaso</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Icônes Tabler -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/dist/tabler-icons.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ mobileNavOpen: false }">

        @php
            $navLinks = [
                ['label' => 'Accueil', 'route' => 'home', 'fallback' => '/'],
                ['label' => 'Ce soir', 'route' => 'ce-soir'],
                ['label' => 'Les lieux', 'route' => 'lieux.index'],
                ['label' => 'Découvrir', 'route' => 'decouvrir'],
                ['label' => 'Agenda', 'route' => 'agenda'],
            ];
        @endphp

        {{-- Bandeau festival --}}
        @isset($festivalActif)
            <div class="bg-primary-600 text-white text-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex flex-wrap items-center justify-center gap-x-3 gap-y-1 text-center">
                    <i class="ti ti-star-filled text-secondary-300"></i>
                    <span class="font-semibold">{{ $festivalActif->nom }}{{ $festivalActif->edition ? ' — '.$festivalActif->edition : '' }}</span>
                    <span class="hidden sm:inline">
                        du {{ $festivalActif->date_debut->locale('fr')->translatedFormat('d M') }}
                        au {{ $festivalActif->date_fin->locale('fr')->translatedFormat('d M Y') }}
                    </span>
                    <a href="{{ Route::has('festival.actif') ? route('festival.actif') : '#' }}" class="underline underline-offset-2 font-medium hover:text-secondary-200">
                        Voir le programme
                    </a>
                </div>
            </div>
        @endisset

        <header class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <a href="{{ Route::has('home') ? route('home') : '/' }}" class="flex items-center gap-2 shrink-0">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-600 text-white font-bold">
                            <i class="ti ti-movie"></i>
                        </span>
                        <span class="text-lg font-bold text-primary-700">Ciné<span class="text-secondary-600">Faso</span></span>
                    </a>

                    <nav class="hidden md:flex items-center gap-6">
                        @foreach ($navLinks as $link)
                            @php $href = Route::has($link['route']) ? route($link['route']) : ($link['fallback'] ?? '#'); @endphp
                            <a href="{{ $href }}"
                               class="text-sm font-medium text-gray-700 hover:text-primary-600 transition {{ Route::has($link['route']) && request()->routeIs($link['route']) ? 'text-primary-600' : '' }}">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </nav>

                    <div class="hidden md:flex items-center gap-3">
                        @auth
                            <a href="{{ route(auth()->user()->dashboardRoute()) }}"
                               class="inline-flex items-center gap-1.5 rounded-md bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700 transition">
                                <i class="ti ti-layout-dashboard"></i> Mon espace
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-1.5 rounded-md bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700 transition">
                                <i class="ti ti-door"></i> Espace salle
                            </a>
                        @endauth
                    </div>

                    <button @click="mobileNavOpen = !mobileNavOpen" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:bg-gray-100" aria-label="Ouvrir le menu">
                        <i class="ti text-2xl" :class="mobileNavOpen ? 'ti-x' : 'ti-menu-2'"></i>
                    </button>
                </div>
            </div>

            {{-- Menu mobile --}}
            <div x-show="mobileNavOpen" x-cloak @click.outside="mobileNavOpen = false" class="md:hidden border-t border-gray-200 bg-white">
                <nav class="px-4 py-3 space-y-1">
                    @foreach ($navLinks as $link)
                        @php $href = Route::has($link['route']) ? route($link['route']) : ($link['fallback'] ?? '#'); @endphp
                        <a href="{{ $href }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-primary-600">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <div class="pt-2 mt-2 border-t border-gray-200">
                        @auth
                            <a href="{{ route(auth()->user()->dashboardRoute()) }}" class="block rounded-md px-3 py-2 text-base font-medium text-primary-700">
                                <i class="ti ti-layout-dashboard"></i> Mon espace
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-primary-700">
                                <i class="ti ti-door"></i> Espace salle
                            </a>
                        @endauth
                    </div>
                </nav>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="mt-16 border-t border-gray-200 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-primary-700 font-bold">
                        <i class="ti ti-movie"></i> CinéFaso
                    </div>
                    <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm text-gray-600">
                        @foreach ($navLinks as $link)
                            @php $href = Route::has($link['route']) ? route($link['route']) : ($link['fallback'] ?? '#'); @endphp
                            <a href="{{ $href }}" class="hover:text-primary-600">{{ $link['label'] }}</a>
                        @endforeach
                    </nav>
                </div>
                <p class="mt-6 text-center sm:text-left text-xs text-gray-400">
                    &copy; {{ now()->year }} CinéFaso — La capitale du cinéma africain mérite une plateforme à sa hauteur. Ouagadougou, Burkina Faso.
                </p>
            </div>
        </footer>
    </body>
</html>
