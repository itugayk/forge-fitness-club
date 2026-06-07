<x-layouts.app title="Galeri"
    description="Forge Fitness Club'tan kareler: tesisimiz, dersler, üye dönüşümleri ve etkinlikler.">

    <x-page-hero
        eyebrow="Galeri"
        title="Forge'da Bir Gün"
        subtitle="Tesisimiz, derslerimiz, dönüşüm hikayeleri ve etkinliklerimizden kareler."
        image="{{ \App\Support\DemoImage::unsplash('1534367610401-9f5ed68180aa', 1600, 900) }}" />

    <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
             x-data="{ filter: 'all' }">

            {{-- Filters --}}
            @php $cats = $images->pluck('category')->unique()->values(); @endphp
            <div class="flex flex-wrap gap-2 mb-8">
                <button @click="filter = 'all'"
                        :class="filter === 'all' ? 'bg-volt-300 text-black border-volt-300' : 'text-zinc-300 border-white/15 hover:border-white/30'"
                        class="px-4 py-2 text-sm font-bold uppercase tracking-wide border transition-colors">Tümü</button>
                @foreach ($cats as $cat)
                    <button @click="filter = '{{ $cat }}'"
                            :class="filter === '{{ $cat }}' ? 'bg-volt-300 text-black border-volt-300' : 'text-zinc-300 border-white/15 hover:border-white/30'"
                            class="px-4 py-2 text-sm font-bold uppercase tracking-wide border transition-colors">{{ $cat }}</button>
                @endforeach
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($images as $i => $img)
                    <div x-show="filter === 'all' || filter === '{{ $img->category }}'" x-transition.opacity
                         class="group relative overflow-hidden {{ $i % 7 === 0 ? 'col-span-2 row-span-2' : '' }} aspect-square">
                        <img src="{{ $img->image_url }}" alt="{{ $img->title }}" loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-ink/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <div>
                                <span class="text-volt-300 text-[10px] font-bold uppercase tracking-widest">{{ $img->category }}</span>
                                <p class="text-white text-sm font-bold">{{ $img->title }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-layouts.app>
