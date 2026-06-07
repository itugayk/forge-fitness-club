@props([
    'title',
    'eyebrow' => null,
    'subtitle' => null,
    'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1600&q=80',
])

<section class="relative pt-32 lg:pt-44 pb-16 lg:pb-24 overflow-hidden bg-ink">
    <div class="absolute inset-0">
        <img src="{{ $image }}" alt="" class="w-full h-full object-cover opacity-25">
        <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/80 to-ink/60"></div>
        <div class="absolute inset-0 bg-grid opacity-30"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($eyebrow)
            <x-ui.eyebrow :label="$eyebrow" />
        @endif
        <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl text-white uppercase leading-[0.95]">
            {{ $title }}
        </h1>
        @if ($subtitle)
            <p class="mt-5 max-w-2xl text-lg text-zinc-300">{{ $subtitle }}</p>
        @endif
        {{ $slot }}
    </div>
    <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-volt-300/60 to-transparent"></div>
</section>
