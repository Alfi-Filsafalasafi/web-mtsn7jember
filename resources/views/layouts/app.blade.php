<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MTSN 7 Jember')</title>
    <meta name="description" content="@yield('description', 'Website Resmi MTSN 7 Jember')">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a5c2a',
                        'primary-light': '#2d7a3a',
                        accent: '#e8521a',
                        gold: '#c8961a',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-white text-gray-800 antialiased">

    {{-- TOP BAR --}}
    <div style="background-color: #1a5c2a;" class="text-white text-xs py-2 hidden md:block">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <span>Selamat Datang di Website Resmi MTSN 7 Jember</span>
            <div class="flex items-center gap-6">
                <span>{{ \App\Models\Setting::get('phone', '(0331) 000000') }}</span>
                <span>{{ \App\Models\Setting::get('email', 'info@mtsn7jember.sch.id') }}</span>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-auto">
                    <div>
                        <p class="font-bold text-base leading-tight" style="color: #1a5c2a;">MTSN 7 Jember</p>
                        <p class="text-xs text-gray-400 leading-tight">Madrasah Tsanawiyah Negeri 7 Jember</p>
                    </div>
                </a>

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center">
                    @php
                    $menus = [
                    ['route' => 'home', 'label' => 'Beranda'],
                    ['route' => 'profile', 'label' => 'Profil'],
                    ['route' => 'articles', 'label' => 'Berita'],
                    ['route' => 'teachers', 'label' => 'Guru & Staf'],
                    ['route' => 'contact', 'label' => 'Kontak'],
                    ];
                    @endphp
                    @foreach ($menus as $menu)
                    <a href="{{ route($menu['route']) }}"
                        class="relative px-4 py-6 text-sm font-semibold transition-colors duration-200
                               {{ request()->routeIs($menu['route']) ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">
                        {{ $menu['label'] }}
                        @if (request()->routeIs($menu['route']))
                        <span class="absolute bottom-0 left-0 w-full h-0.5" style="background-color: #1a5c2a;"></span>
                        @endif
                    </a>
                    @endforeach
                </div>

                {{-- Hamburger --}}
                <button id="menu-toggle" class="md:hidden p-2">
                    <svg id="icon-open" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="icon-close" class="w-6 h-6 text-gray-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
            @foreach ($menus as $menu)
            <a href="{{ route($menu['route']) }}"
                class="block px-6 py-3 text-sm font-semibold border-b border-gray-50
                       {{ request()->routeIs($menu['route']) ? 'text-white' : 'text-gray-600' }}"
                style="{{ request()->routeIs($menu['route']) ? 'background-color:#1a5c2a;' : '' }}">
                {{ $menu['label'] }}
            </a>
            @endforeach
        </div>
    </nav>

    {{-- PAGE HEADER (untuk halaman selain beranda) --}}
    @hasSection('page-header')
    <div style="background: linear-gradient(to right, #1a5c2a, #2d7a3a);" class="py-10">
        <div class="max-w-7xl mx-auto px-6 text-white">
            <h1 class="text-3xl font-bold">@yield('page-header')</h1>
            <p class="text-green-200 text-sm mt-1">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">/</span>
                @yield('page-header')
            </p>
        </div>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer style="background-color: #1a5c2a;" class="text-white mt-16">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 brightness-0 invert">
                        <div>
                            <p class="font-bold text-base">MTSN 7 Jember</p>
                            <p class="text-green-300 text-xs">Madrasah Tsanawiyah Negeri</p>
                        </div>
                    </div>
                    <p class="text-green-200 text-sm leading-relaxed">
                        Mencetak generasi yang berakhlak mulia, berprestasi, dan berwawasan global berlandaskan nilai-nilai Islam.
                    </p>
                </div>
                <div>
                    <p class="font-semibold text-base mb-4 border-b border-green-700 pb-2">Navigasi</p>
                    <ul class="space-y-2 text-sm text-green-200">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('profile') }}" class="hover:text-white transition">Profil Sekolah</a></li>
                        <li><a href="{{ route('articles') }}" class="hover:text-white transition">Berita & Pengumuman</a></li>
                        <li><a href="{{ route('teachers') }}" class="hover:text-white transition">Guru & Staf</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <p class="font-semibold text-base mb-4 border-b border-green-700 pb-2">Kontak Kami</p>
                    <ul class="space-y-3 text-sm text-green-200">
                        <li class="flex gap-2">
                            <span>📍</span>
                            <span>{{ \App\Models\Setting::get('address', 'Jember, Jawa Timur') }}</span>
                        </li>
                        <li class="flex gap-2">
                            <span>📞</span>
                            <span>{{ \App\Models\Setting::get('phone', '-') }}</span>
                        </li>
                        <li class="flex gap-2">
                            <span>✉️</span>
                            <span>{{ \App\Models\Setting::get('email', '-') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-green-700 mt-10 pt-6 text-center text-green-300 text-sm">
                &copy; {{ date('Y') }} MTSN 7 Jember. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>

</html>