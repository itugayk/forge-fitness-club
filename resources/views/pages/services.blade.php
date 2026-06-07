<x-layouts.app title="Hizmetler & Üyelik"
    description="Gym, grup dersleri, kişisel antrenörlük, beslenme danışmanlığı ve daha fazlası. Forge Fitness Club üyelik paketlerini keşfet.">

    <x-page-hero
        eyebrow="Ne Sunuyoruz"
        title="Hizmetler & Üyelik"
        subtitle="Tek çatı altında ihtiyacın olan her şey: ekipman, ders, antrenör, beslenme ve toparlanma."
        image="{{ \App\Support\DemoImage::unsplash('1517836357463-d25dfeac3438', 1600, 900) }}" />

    {{-- Services --}}
    <section class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 lg:space-y-24">
            @foreach ($services as $i => $service)
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-14 items-center">
                    <div class="{{ $i % 2 === 1 ? 'lg:order-2' : '' }}">
                        <div class="relative overflow-hidden group">
                            <img src="{{ $service->image_url ?? \App\Support\DemoImage::unsplash('1534438327276-14e5300c3a48', 1000, 700) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full aspect-[4/3] object-cover {{ $i % 2 === 1 ? 'clip-diag-t' : 'clip-diag-b' }} group-hover:scale-105 transition-transform duration-700">
                        </div>
                    </div>
                    <div class="{{ $i % 2 === 1 ? 'lg:order-1' : '' }}">
                        <span class="grid place-items-center w-14 h-14 bg-volt-300/10 text-volt-300 skew-x-[-8deg] mb-5">
                            <x-dynamic-component :component="$service->icon" class="w-7 h-7 skew-x-[8deg]" />
                        </span>
                        <span class="text-volt-300 font-bold text-xs uppercase tracking-[0.25em]">0{{ $i + 1 }}</span>
                        <h2 class="font-display text-4xl lg:text-5xl text-white uppercase leading-none mt-1">{{ $service->title }}</h2>
                        <p class="mt-4 text-zinc-300 leading-relaxed">{{ $service->description }}</p>
                        @if ($service->features)
                            <ul class="mt-6 grid sm:grid-cols-2 gap-3">
                                @foreach ($service->features as $feature)
                                    <li class="flex items-center gap-2.5 text-sm text-zinc-300">
                                        <x-heroicon-s-check-circle class="w-5 h-5 text-volt-300 shrink-0" />{{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Pricing --}}
    <section id="uyelik" class="relative py-20 lg:py-28 bg-ink-2 border-y border-white/10">
        <div class="absolute inset-0 bg-grid opacity-30 pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-4">
                <x-ui.eyebrow label="Üyelik Paketleri" center />
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white uppercase leading-none">
                    Sana Uygun <span class="text-volt-300">Plan</span>
                </h2>
                <p class="mt-4 text-zinc-400 max-w-xl mx-auto">Aylık, 3 aylık veya yıllık. Taahhüt yok,
                    istediğin an yükselt. İlk antrenmanın ücretsiz.</p>
            </div>
            <x-pricing-table :plans="$plans" />
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-display text-4xl sm:text-5xl text-white uppercase leading-none">Hâlâ kararsız mısın?</h2>
            <p class="mt-4 text-zinc-300">Tesisimizi gez, eğitmenlerimizle tanış. Sana en uygun planı birlikte bulalım.</p>
            <div class="mt-7 flex flex-wrap justify-center gap-4">
                <a href="{{ route('join') }}" class="bg-volt-300 hover:bg-volt-200 text-black font-extrabold uppercase tracking-wide px-7 py-4 skew-x-[-8deg] transition-colors"><span class="block skew-x-[8deg]">Üye Ol</span></a>
                <a href="{{ route('contact') }}" class="border border-white/25 hover:border-volt-300 hover:text-volt-300 text-white font-bold uppercase tracking-wide px-7 py-4 skew-x-[-8deg] transition-colors"><span class="block skew-x-[8deg]">Randevu Al</span></a>
            </div>
        </div>
    </section>

</x-layouts.app>
