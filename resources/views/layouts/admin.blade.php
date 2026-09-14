<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Espace gérant') — CinéFaso</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/dist/tabler-icons.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900" x-data="{ sidebarOpen: false }">

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
                   class="fixed inset-y-0 left-0 z-30 w-64 bg-primary-700 text-white transform transition-transform duration-200 md:translate-x-0 md:static md:flex md:flex-col">
                <div class="h-16 flex items-center gap-2 px-6 border-b border-white/10">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-primary-700 font-bold">
                        <i class="ti ti-movie"></i>
                    </span>
                    <span class="font-bold">CinéFaso</span>
                </div>

                <div class="px-6 py-4 text-sm text-white/70 border-b border-white/10">
                    {{ auth()->user()->lieu?->nom ?? 'Espace gérant' }}
                </div>

                <nav class="flex-1 px-3 py-4 space-y-1">
                    @foreach ($adminLinks as $link)
                        @php $active = Route::has($link['route']) && request()->routeIs($link['route'].'*'); @endphp
                        <a href="{{ Route::has($link['route']) ? route($link['route']) : '#' }}"
                           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition {{ $active ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            <i class="ti {{ $link['icon'] }}"></i>
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="px-3 py-4 border-t border-white/10 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white">
                        <i class="ti ti-user"></i> Mon profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white">
                            <i class="ti ti-logout"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </aside>

            <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black/40 md:hidden"></div>

            {{-- Content --}}
            <div class="flex-1 flex flex-col min-w-0">
                <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 -ml-2 text-gray-600" aria-label="Ouvrir le menu">
                        <i class="ti ti-menu-2 text-2xl"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Espace gérant')</h1>
                    <span class="text-sm text-gray-500 hidden sm:inline">{{ auth()->user()->nom }}</span>
                </header>

                <main class="flex-1 p-4 sm:p-6">
                    @include('partials.flash-messages')
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
