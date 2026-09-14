<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Espace gérant') — CinéFaso</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/dist/tabler-icons.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="backoffice-dark font-body antialiased bg-cf-bg text-cf-ink" x-data="{ sidebarOpen: false }">

        @php
            $adminLinks = [
                ['label' => 'Tableau de bord', 'icon' => 'ti-layout-dashboard', 'route' => 'admin.dashboard'],
                ['label' => 'Séances', 'icon' => 'ti-clock', 'route' => 'admin.seances.index'],
                ['label' => 'Événements', 'icon' => 'ti-calendar-event', 'route' => 'admin.evenements.index'],
                ['label' => 'Ma salle', 'icon' => 'ti-building', 'route' => 'admin.lieu.edit'],
            ];
        @endphp

        <div class="min-h-screen flex">
            {{-- Sidebar --}}
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                   class="fixed inset-y-0 left-0 z-30 w-64 bg-cf-surface border-r border-cf-line text-cf-ink transform transition-transform duration-200 md:translate-x-0 md:static md:flex md:flex-col">
                <div class="h-16 flex items-center gap-2 px-6 border-b border-cf-line">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-cf-gold text-cf-gold-ink font-bold">
                        <i class="ti ti-movie"></i>
                    </span>
                    <span class="font-display font-bold">Ciné<span class="text-cf-gold">Faso</span></span>
                </div>

                <div class="px-6 py-4 text-sm text-cf-muted border-b border-cf-line">
                    {{ auth()->user()->lieu?->nom ?? 'Espace gérant' }}
                </div>

                <nav class="flex-1 px-3 py-4 space-y-1">
                    @foreach ($adminLinks as $link)
                        @php $active = Route::has($link['route']) && request()->routeIs($link['route'].'*'); @endphp
                        <a href="{{ Route::has($link['route']) ? route($link['route']) : '#' }}"
                           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition {{ $active ? 'bg-cf-gold/15 text-cf-gold' : 'text-cf-muted hover:bg-cf-surface-2 hover:text-cf-ink' }}">
                            <i class="ti {{ $link['icon'] }}"></i>
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="px-3 py-4 border-t border-cf-line space-y-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-cf-muted hover:bg-cf-surface-2 hover:text-cf-ink">
                        <i class="ti ti-user"></i> Mon profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-cf-muted hover:bg-cf-surface-2 hover:text-cf-ink">
                            <i class="ti ti-logout"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </aside>

            <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black/60 md:hidden"></div>

            {{-- Content --}}
            <div class="flex-1 flex flex-col min-w-0">
                <header class="h-16 bg-cf-surface border-b border-cf-line flex items-center justify-between px-4 sm:px-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 -ml-2 text-cf-muted" aria-label="Ouvrir le menu">
                        <i class="ti ti-menu-2 text-2xl"></i>
                    </button>
                    <h1 class="font-display text-lg font-semibold text-cf-ink">@yield('page-title', 'Espace gérant')</h1>
                    <span class="text-sm text-cf-muted hidden sm:inline">{{ auth()->user()->nom }}</span>
                </header>

                <main class="flex-1 p-4 sm:p-6">
                    @include('partials.flash-messages')
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
