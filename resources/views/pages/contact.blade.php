<x-layouts.app title="İletişim"
    description="Forge Fitness Club ile iletişime geç. Adres, telefon, e-posta ve çalışma saatleri.">

    <x-page-hero
        eyebrow="İletişim"
        title="Bize Ulaş"
        subtitle="Sorularını yanıtlamak, tesisimizi gezdirmek ve sana en uygun planı bulmak için buradayız."
        image="{{ \App\Support\DemoImage::unsplash('1532384748853-8f54a8f476e2', 1600, 900) }}" />

    <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Info --}}
                <div>
                    <x-ui.eyebrow label="Bilgiler" />
                    <h2 class="font-display text-4xl text-white uppercase leading-none mb-6">Forge Fitness Club</h2>
                    <p class="text-zinc-300 mb-8 max-w-md">{{ config('forge.description') }}</p>

                    <ul class="space-y-5">
                        <li class="flex items-start gap-4">
                            <span class="grid place-items-center w-11 h-11 bg-volt-300/10 text-volt-300 shrink-0"><x-heroicon-m-map-pin class="w-5 h-5" /></span>
                            <div>
                                <div class="text-xs uppercase tracking-widest text-zinc-500">Adres</div>
                                <div class="text-zinc-200">{{ config('forge.address') }}, {{ config('forge.district') }} / {{ config('forge.city') }}</div>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="grid place-items-center w-11 h-11 bg-volt-300/10 text-volt-300 shrink-0"><x-heroicon-m-phone class="w-5 h-5" /></span>
                            <div>
                                <div class="text-xs uppercase tracking-widest text-zinc-500">Telefon</div>
                                <a href="tel:{{ preg_replace('/\s+/', '', config('forge.phone')) }}" class="text-zinc-200 hover:text-volt-300">{{ config('forge.phone') }}</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="grid place-items-center w-11 h-11 bg-volt-300/10 text-volt-300 shrink-0"><x-heroicon-m-envelope class="w-5 h-5" /></span>
                            <div>
                                <div class="text-xs uppercase tracking-widest text-zinc-500">E-posta</div>
                                <a href="mailto:{{ config('forge.email') }}" class="text-zinc-200 hover:text-volt-300">{{ config('forge.email') }}</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="grid place-items-center w-11 h-11 bg-volt-300/10 text-volt-300 shrink-0"><x-heroicon-m-clock class="w-5 h-5" /></span>
                            <div>
                                <div class="text-xs uppercase tracking-widest text-zinc-500 mb-1">Çalışma Saatleri</div>
                                @foreach (config('forge.hours') as $day => $time)
                                    <div class="text-sm text-zinc-300 flex justify-between gap-6"><span>{{ $day }}</span><span class="text-zinc-200">{{ $time }}</span></div>
                                @endforeach
                            </div>
                        </li>
                    </ul>

                    <div class="mt-8 overflow-hidden border border-white/10">
                        <iframe
                            src="https://maps.google.com/maps?q={{ config('forge.latitude') }},{{ config('forge.longitude') }}&z=14&output=embed"
                            class="w-full h-64 grayscale contrast-125" style="filter: grayscale(1) invert(0.9) hue-rotate(180deg);"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                {{-- Form --}}
                <div>
                    <div class="bg-ink-3 border border-white/10 p-7 lg:p-9">
                        <h3 class="font-display text-3xl text-white uppercase tracking-wide mb-1">Mesaj Gönder</h3>
                        <p class="text-sm text-zinc-400 mb-6">Formu doldur, en kısa sürede dönüş yapalım.</p>
                        <livewire:contact-form />
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
