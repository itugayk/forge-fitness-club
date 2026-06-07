@props([
    'title' => null,
    'description' => null,
    'transparentNav' => false,
    'ogImage' => null,
])

@php
    $pageTitle = $title ? $title.' · '.config('forge.brand') : config('forge.brand').' — '.config('forge.tagline');
    $metaDesc = $description ?? config('forge.description');
    $nav = [
        ['route' => 'home', 'label' => 'Ana Sayfa'],
        ['route' => 'timetable', 'label' => 'Ders Programı'],
        ['route' => 'services', 'label' => 'Hizmetler & Üyelik'],
        ['route' => 'trainers', 'label' => 'Eğitmenler'],
        ['route' => 'gallery', 'label' => 'Galeri'],
        ['route' => 'blog', 'label' => 'Blog'],
        ['route' => 'contact', 'label' => 'İletişim'],
    ];
@endphp
<!DOCTYPE html>
<html lang="tr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('forge.brand') }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($ogImage)<meta property="og:image" content="{{ $ogImage }}">@endif
    <meta name="twitter:card" content="summary_large_image">

    {{-- Fonts: Anton + Bebas Neue (display) + Inter (body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    {{-- Global JSON-LD: ExerciseGym / SportsActivityLocation --}}
    @include('partials.jsonld')
    {{ $structuredData ?? '' }}
</head>
<body class="bg-ink text-zinc-200 min-h-screen flex flex-col antialiased selection:bg-volt-300 selection:text-black">

    {{-- ============================ NAV ============================ --}}
    <header
        x-data="{ scrolled: false, open: false }"
        x-init="scrolled = window.scrollY > 40"
        @scroll.window="scrolled = window.scrollY > 40"
        :class="(scrolled || {{ $transparentNav ? 'false' : 'true' }} || open)
            ? 'bg-ink/95 backdrop-blur border-b border-white/10 shadow-lg shadow-black/40'
            : 'bg-transparent border-b border-transparent'"
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <span class="grid place-items-center w-9 h-9 bg-volt-300 text-black skew-x-[-8deg] group-hover:rotate-3 transition-transform">
                        <x-heroicon-s-bolt class="w-5 h-5" />
                    </span>
                    <span class="font-display text-2xl tracking-wide leading-none">
                        FORGE<span class="text-volt-300">.</span>
                    </span>
                </a>

                {{-- Desktop menu --}}
                <div class="hidden lg:flex items-center gap-7">
                    @foreach ($nav as $item)
                        <a href="{{ route($item['route']) }}"
                           class="text-sm font-semibold tracking-wide uppercase transition-colors hover:text-volt-300 {{ request()->routeIs($item['route']) ? 'text-volt-300' : 'text-zinc-300' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>

                <div class="hidden lg:block">
                    <a href="{{ route('join') }}"
                       class="inline-flex items-center gap-2 bg-volt-300 hover:bg-volt-200 text-black font-bold text-sm uppercase tracking-wide px-5 py-2.5 skew-x-[-8deg] transition-colors">
                        <span class="skew-x-[8deg] flex items-center gap-2">Hemen Başla <x-heroicon-m-arrow-right class="w-4 h-4" /></span>
                    </a>
                </div>

                {{-- Mobile toggle --}}
                <button @click="open = !open" class="lg:hidden text-zinc-200 p-2 -mr-2" aria-label="Menü">
                    <x-heroicon-o-bars-3 x-show="!open" class="w-7 h-7" />
                    <x-heroicon-o-x-mark x-show="open" x-cloak class="w-7 h-7" />
                </button>
            </div>
        </nav>

        {{-- Mobile menu --}}
        <div x-show="open" x-cloak x-transition.opacity class="lg:hidden bg-ink-2 border-t border-white/10">
            <div class="px-4 py-4 space-y-1">
                @foreach ($nav as $item)
                    <a href="{{ route($item['route']) }}"
                       class="block px-3 py-2.5 font-semibold uppercase text-sm tracking-wide rounded {{ request()->routeIs($item['route']) ? 'text-volt-300 bg-white/5' : 'text-zinc-300 hover:bg-white/5' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
                <a href="{{ route('join') }}" class="block text-center mt-3 bg-volt-300 text-black font-bold uppercase tracking-wide px-5 py-3">
                    Hemen Başla
                </a>
            </div>
        </div>
    </header>

    {{-- ============================ MAIN ============================ --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- ============================ FOOTER ============================ --}}
    <footer class="relative bg-ink-2 border-t border-white/10 mt-auto">
        <div class="absolute inset-0 bg-grid opacity-40 pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="grid place-items-center w-9 h-9 bg-volt-300 text-black skew-x-[-8deg]">
                            <x-heroicon-s-bolt class="w-5 h-5" />
                        </span>
                        <span class="font-display text-2xl tracking-wide">FORGE<span class="text-volt-300">.</span></span>
                    </div>
                    <p class="text-sm text-zinc-400 leading-relaxed">{{ config('forge.description') }}</p>
                    <div class="flex gap-3 mt-5">
                        @foreach (config('forge.social') as $platform => $url)
                            <a href="{{ $url }}" target="_blank" rel="noopener"
                               class="grid place-items-center w-9 h-9 border border-white/15 text-zinc-300 hover:bg-volt-300 hover:text-black hover:border-volt-300 transition-colors">
                                <span class="text-xs font-bold uppercase">{{ substr($platform, 0, 2) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h4 class="font-display text-lg tracking-wide text-white mb-4">Keşfet</h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach ($nav as $item)
                            <li><a href="{{ route($item['route']) }}" class="text-zinc-400 hover:text-volt-300 transition-colors">{{ $item['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="font-display text-lg tracking-wide text-white mb-4">Çalışma Saatleri</h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach (config('forge.hours') as $day => $time)
                            <li class="flex justify-between gap-4 text-zinc-400">
                                <span>{{ $day }}</span><span class="text-zinc-200 font-medium">{{ $time }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="font-display text-lg tracking-wide text-white mb-4">İletişim</h4>
                    <ul class="space-y-3 text-sm text-zinc-400">
                        <li class="flex items-start gap-2.5">
                            <x-heroicon-m-map-pin class="w-5 h-5 text-volt-300 shrink-0" />
                            <span>{{ config('forge.address') }}, {{ config('forge.district') }} / {{ config('forge.city') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <x-heroicon-m-phone class="w-5 h-5 text-volt-300 shrink-0" />
                            <a href="tel:{{ preg_replace('/\s+/', '', config('forge.phone')) }}" class="hover:text-volt-300">{{ config('forge.phone') }}</a>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <x-heroicon-m-envelope class="w-5 h-5 text-volt-300 shrink-0" />
                            <a href="mailto:{{ config('forge.email') }}" class="hover:text-volt-300">{{ config('forge.email') }}</a>
                        </li>
                    </ul>
                    <a href="{{ route('join') }}" class="inline-flex mt-5 bg-volt-300 hover:bg-volt-200 text-black font-bold text-sm uppercase tracking-wide px-5 py-2.5 skew-x-[-8deg]">
                        <span class="skew-x-[8deg]">Üye Ol</span>
                    </a>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-zinc-500">
                <p>© {{ date('Y') }} {{ config('forge.brand') }}. Tüm hakları saklıdır.</p>
                <p>Demo · <a href="https://fitness.demo.dijifa.com" class="hover:text-volt-300">fitness.demo.dijifa.com</a></p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
