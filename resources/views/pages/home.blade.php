<x-layouts.app :transparent-nav="true">

    {{-- ============================ HERO ============================ --}}
    <section class="relative min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ \App\Support\DemoImage::unsplash('1534438327276-14e5300c3a48', 1920, 1280) }}"
                 alt="Forge Fitness Club" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-ink via-ink/85 to-ink/40"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-ink via-transparent to-ink/50"></div>
            <div class="absolute inset-0 bg-grid opacity-20"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20 w-full">
            <div class="max-w-3xl">
                <x-ui.eyebrow label="İstanbul · Kadıköy" />
                <h1 class="font-display text-6xl sm:text-7xl lg:text-8xl text-white uppercase leading-[0.88]">
                    Kendini <span class="text-volt-300">Dövüştür.</span><br>
                    Daha Güçlü <span class="text-stroke">Çık.</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-zinc-300 max-w-xl leading-relaxed">
                    Premium ekipman, 50+ haftalık grup dersi, uzman antrenörler ve seni hedefine
                    taşıyan bir topluluk. Forge'da limit yok, sadece sonuç var.
                </p>
                <div class="mt-9 flex flex-wrap items-center gap-4">
                    <a href="{{ route('join') }}"
                       class="group inline-flex items-center gap-2 bg-volt-300 hover:bg-volt-200 text-black font-extrabold uppercase tracking-wide px-7 py-4 skew-x-[-8deg] transition-colors">
                        <span class="skew-x-[8deg] flex items-center gap-2">Hemen Başla
                            <x-heroicon-m-arrow-right class="w-5 h-5 group-hover:translate-x-1 transition-transform" /></span>
                    </a>
                    <a href="{{ route('timetable') }}"
                       class="inline-flex items-center gap-2 border border-white/25 hover:border-volt-300 hover:text-volt-300 text-white font-bold uppercase tracking-wide px-7 py-4 skew-x-[-8deg] transition-colors">
                        <span class="skew-x-[8deg] flex items-center gap-2"><x-heroicon-m-calendar-days class="w-5 h-5" /> Ders Programı</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Hero stats strip --}}
        <div class="absolute bottom-0 inset-x-0 border-t border-white/10 bg-ink/70 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 divide-x divide-white/10">
                <div class="py-5 px-4 text-center md:text-left">
                    <div class="font-display text-3xl text-white">{{ number_format($stats['members'], 0, ',', '.') }}+</div>
                    <div class="text-xs uppercase tracking-widest text-zinc-400 mt-1">Aktif Üye</div>
                </div>
                <div class="py-5 px-4 text-center md:text-left">
                    <div class="font-display text-3xl text-white">{{ $stats['classes'] }}+</div>
                    <div class="text-xs uppercase tracking-widest text-zinc-400 mt-1">Haftalık Ders</div>
                </div>
                <div class="py-5 px-4 text-center md:text-left">
                    <div class="font-display text-3xl text-white">{{ $stats['trainers'] }}</div>
                    <div class="text-xs uppercase tracking-widest text-zinc-400 mt-1">Uzman Eğitmen</div>
                </div>
                <div class="py-5 px-4 text-center md:text-left">
                    <div class="font-display text-3xl text-white">{{ $stats['years'] }}</div>
                    <div class="text-xs uppercase tracking-widest text-zinc-400 mt-1">Yıllık Tecrübe</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================ MARQUEE ============================ --}}
    <div class="bg-volt-300 text-black py-3 overflow-hidden">
        <div class="flex whitespace-nowrap animate-marquee">
            @foreach (['CROSSFIT', 'YOGA', 'PILATES', 'SPINNING', 'HIIT', 'KICKBOX', 'KUVVET', 'FONKSİYONEL'] as $w)
                <span class="mx-6 font-display text-xl tracking-wider flex items-center gap-6">{{ $w }} <x-heroicon-s-bolt class="w-4 h-4" /></span>
            @endforeach
            @foreach (['CROSSFIT', 'YOGA', 'PILATES', 'SPINNING', 'HIIT', 'KICKBOX', 'KUVVET', 'FONKSİYONEL'] as $w)
                <span class="mx-6 font-display text-xl tracking-wider flex items-center gap-6">{{ $w }} <x-heroicon-s-bolt class="w-4 h-4" /></span>
            @endforeach
        </div>
    </div>

    {{-- ============================ SERVICES ============================ --}}
    <section class="relative py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
                <div>
                    <x-ui.eyebrow label="Ne Sunuyoruz" />
                    <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white uppercase leading-none">
                        Her Hedefe<br><span class="text-volt-300">Bir Yol</span>
                    </h2>
                </div>
                <p class="max-w-md text-zinc-400">Tek bir çatı altında gym'den grup derslerine, birebir
                    antrenörlükten beslenme danışmanlığına kadar ihtiyacın olan her şey.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $service)
                    <a href="{{ route('services') }}"
                       class="group relative p-7 bg-ink-3 border border-white/10 hover:border-volt-300 overflow-hidden transition-all duration-300">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-volt-300/5 group-hover:bg-volt-300/10 rounded-full blur-xl transition-colors"></div>
                        <div class="relative">
                            <span class="grid place-items-center w-14 h-14 bg-volt-300/10 text-volt-300 group-hover:bg-volt-300 group-hover:text-black transition-colors skew-x-[-8deg] mb-5">
                                <x-dynamic-component :component="$service->icon" class="w-7 h-7 skew-x-[8deg]" />
                            </span>
                            <h3 class="font-display text-2xl text-white uppercase tracking-wide group-hover:text-volt-300 transition-colors">{{ $service->title }}</h3>
                            <p class="mt-2 text-sm text-zinc-400 leading-relaxed">{{ $service->short_description }}</p>
                            <span class="inline-flex items-center gap-1.5 mt-5 text-xs font-bold uppercase tracking-widest text-volt-300">
                                Keşfet <x-heroicon-m-arrow-long-right class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================ PRICING ============================ --}}
    <section class="relative py-20 lg:py-28 bg-ink-2 border-y border-white/10">
        <div class="absolute inset-0 bg-grid opacity-30 pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-4">
                <x-ui.eyebrow label="Üyelik Paketleri" center />
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white uppercase leading-none">
                    Seviyeni <span class="text-volt-300">Seç</span>
                </h2>
                <p class="mt-4 text-zinc-400 max-w-xl mx-auto">İptal yok, gizli ücret yok. İstediğin an
                    yükselt. İlk antrenmanın bizden.</p>
            </div>

            <x-pricing-table :plans="$plans" />
        </div>
    </section>

    {{-- ============================ TRAINERS ============================ --}}
    <section class="relative py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
                <div>
                    <x-ui.eyebrow label="Kadromuz" />
                    <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white uppercase leading-none">
                        Seni Zorlayacak<br><span class="text-volt-300">Uzmanlar</span>
                    </h2>
                </div>
                <a href="{{ route('trainers') }}" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-volt-300 hover:gap-3 transition-all">
                    Tüm Eğitmenler <x-heroicon-m-arrow-long-right class="w-5 h-5" />
                </a>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($trainers as $trainer)
                    <a href="{{ route('trainer.show', $trainer) }}" class="group relative block overflow-hidden bg-ink-3 border border-white/10 hover:border-volt-300 transition-colors">
                        <div class="aspect-[3/4] overflow-hidden">
                            <img src="{{ $trainer->photo_url }}" alt="{{ $trainer->name }}"
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/30 to-transparent"></div>
                        <div class="absolute bottom-0 inset-x-0 p-5">
                            <p class="text-volt-300 text-xs font-bold uppercase tracking-widest">{{ $trainer->specialty }}</p>
                            <h3 class="font-display text-2xl text-white uppercase tracking-wide leading-none mt-1">{{ $trainer->name }}</h3>
                            <p class="text-xs text-zinc-400 mt-1">{{ $trainer->title }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================ TIMETABLE CTA ============================ --}}
    <section class="relative py-16 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ \App\Support\DemoImage::unsplash('1571019613454-1cb2f99b2d8b', 1600, 600) }}" alt="" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-ink/85"></div>
        </div>
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <x-ui.eyebrow label="Haftalık Program" center />
            <h2 class="font-display text-4xl sm:text-5xl text-white uppercase leading-none">
                50+ Ders Seni Bekliyor
            </h2>
            <p class="mt-4 text-zinc-300 max-w-xl mx-auto">Gün ve saatini seç, dersini incele, yerini
                anında ayır. Programı canlı kontenjanlarla keşfet.</p>
            <a href="{{ route('timetable') }}"
               class="inline-flex items-center gap-2 mt-8 bg-volt-300 hover:bg-volt-200 text-black font-extrabold uppercase tracking-wide px-7 py-4 skew-x-[-8deg] transition-colors">
                <span class="skew-x-[8deg] flex items-center gap-2">Programı Gör <x-heroicon-m-arrow-right class="w-5 h-5" /></span>
            </a>
        </div>
    </section>

    {{-- ============================ GALLERY PREVIEW ============================ --}}
    <section class="relative py-20 lg:py-28 bg-ink-2 border-y border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
                <div>
                    <x-ui.eyebrow label="Galeri" />
                    <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white uppercase leading-none">
                        Forge'da <span class="text-volt-300">Bir Gün</span>
                    </h2>
                </div>
                <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-volt-300 hover:gap-3 transition-all">
                    Tüm Galeri <x-heroicon-m-arrow-long-right class="w-5 h-5" />
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @foreach ($gallery as $i => $img)
                    <div class="group relative overflow-hidden {{ $i % 6 === 0 ? 'md:row-span-2 aspect-square md:aspect-auto' : 'aspect-square' }}">
                        <img src="{{ $img->image_url }}" alt="{{ $img->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-ink/0 group-hover:bg-ink/40 transition-colors flex items-end p-4">
                            <span class="text-white text-sm font-bold uppercase tracking-wide opacity-0 group-hover:opacity-100 transition-opacity">{{ $img->title }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================ TESTIMONIALS ============================ --}}
    <section class="relative py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <x-ui.eyebrow label="Üye Hikayeleri" center />
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white uppercase leading-none">
                    Onlar <span class="text-volt-300">Başardı</span>
                </h2>
            </div>
            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($testimonials->take(6) as $t)
                    <figure class="flex flex-col p-7 bg-ink-3 border border-white/10">
                        <div class="flex gap-0.5 text-volt-300 mb-4">
                            @for ($s = 0; $s < $t->rating; $s++)<x-heroicon-s-star class="w-4 h-4" />@endfor
                        </div>
                        <blockquote class="text-zinc-300 leading-relaxed flex-1">"{{ $t->content }}"</blockquote>
                        <figcaption class="flex items-center gap-3 mt-6 pt-6 border-t border-white/10">
                            <img src="{{ $t->avatar_url }}" alt="{{ $t->name }}" class="w-11 h-11 rounded-full object-cover">
                            <div>
                                <div class="font-bold text-white text-sm">{{ $t->name }}</div>
                                <div class="text-xs text-zinc-400">{{ $t->role }}</div>
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================ COUNTERS ============================ --}}
    <section class="relative py-16 bg-volt-300 text-black overflow-hidden clip-diag-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-10">
                <div class="text-center">
                    <div class="font-display text-5xl lg:text-6xl leading-none" x-data="{n:0,done:false}"
                         x-init="let s=$data,t={{ $stats['members'] }};new IntersectionObserver(e=>{if(e[0].isIntersecting&&!s.done){s.done=true;let st=null;let f=ts=>{if(!st)st=ts;let p=Math.min((ts-st)/1600,1);s.n=Math.floor(p*t);if(p<1)requestAnimationFrame(f);else s.n=t};requestAnimationFrame(f)}},{threshold:0.4}).observe($el)">
                        <span x-text="n.toLocaleString('tr-TR')">0</span>+
                    </div>
                    <div class="mt-2 text-xs sm:text-sm uppercase tracking-widest font-bold">Mutlu Üye</div>
                </div>
                <div class="text-center">
                    <div class="font-display text-5xl lg:text-6xl leading-none" x-data="{n:0,done:false}"
                         x-init="let s=$data,t={{ $stats['classes'] }};new IntersectionObserver(e=>{if(e[0].isIntersecting&&!s.done){s.done=true;let st=null;let f=ts=>{if(!st)st=ts;let p=Math.min((ts-st)/1600,1);s.n=Math.floor(p*t);if(p<1)requestAnimationFrame(f);else s.n=t};requestAnimationFrame(f)}},{threshold:0.4}).observe($el)">
                        <span x-text="n">0</span>+
                    </div>
                    <div class="mt-2 text-xs sm:text-sm uppercase tracking-widest font-bold">Haftalık Ders</div>
                </div>
                <div class="text-center">
                    <div class="font-display text-5xl lg:text-6xl leading-none" x-data="{n:0,done:false}"
                         x-init="let s=$data,t={{ $stats['pt_sessions'] }};new IntersectionObserver(e=>{if(e[0].isIntersecting&&!s.done){s.done=true;let st=null;let f=ts=>{if(!st)st=ts;let p=Math.min((ts-st)/1600,1);s.n=Math.floor(p*t);if(p<1)requestAnimationFrame(f);else s.n=t};requestAnimationFrame(f)}},{threshold:0.4}).observe($el)">
                        <span x-text="n.toLocaleString('tr-TR')">0</span>+
                    </div>
                    <div class="mt-2 text-xs sm:text-sm uppercase tracking-widest font-bold">Tamamlanan PT</div>
                </div>
                <div class="text-center">
                    <div class="font-display text-5xl lg:text-6xl leading-none" x-data="{n:0,done:false}"
                         x-init="let s=$data,t={{ $stats['trainers'] }};new IntersectionObserver(e=>{if(e[0].isIntersecting&&!s.done){s.done=true;let st=null;let f=ts=>{if(!st)st=ts;let p=Math.min((ts-st)/1600,1);s.n=Math.floor(p*t);if(p<1)requestAnimationFrame(f);else s.n=t};requestAnimationFrame(f)}},{threshold:0.4}).observe($el)">
                        <span x-text="n">0</span>
                    </div>
                    <div class="mt-2 text-xs sm:text-sm uppercase tracking-widest font-bold">Uzman Eğitmen</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================ BLOG PREVIEW ============================ --}}
    @if ($posts->isNotEmpty())
        <section class="relative py-20 lg:py-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
                    <div>
                        <x-ui.eyebrow label="Blog" />
                        <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white uppercase leading-none">
                            Bilgiyle <span class="text-volt-300">Güçlen</span>
                        </h2>
                    </div>
                    <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-volt-300 hover:gap-3 transition-all">
                        Tüm Yazılar <x-heroicon-m-arrow-long-right class="w-5 h-5" />
                    </a>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============================ FINAL CTA ============================ --}}
    <section class="relative py-20 lg:py-28 bg-ink-2 border-t border-white/10 overflow-hidden">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-volt-300/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-flame-400/10 rounded-full blur-3xl"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-display text-5xl sm:text-6xl lg:text-7xl text-white uppercase leading-[0.9]">
                Bahaneler <span class="text-volt-300">Bitti.</span><br>Sıra <span class="text-stroke">Sende.</span>
            </h2>
            <p class="mt-6 text-lg text-zinc-300 max-w-xl mx-auto">Bugün başla. İlk antrenmanın ücretsiz,
                ilk adımın en zoru. Gerisini biz hallederiz.</p>
            <div class="mt-9 flex flex-wrap justify-center gap-4">
                <a href="{{ route('join') }}" class="inline-flex items-center gap-2 bg-volt-300 hover:bg-volt-200 text-black font-extrabold uppercase tracking-wide px-8 py-4 skew-x-[-8deg] transition-colors">
                    <span class="skew-x-[8deg] flex items-center gap-2">Üyeliğe Başla <x-heroicon-m-arrow-right class="w-5 h-5" /></span>
                </a>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 border border-white/25 hover:border-volt-300 hover:text-volt-300 text-white font-bold uppercase tracking-wide px-8 py-4 skew-x-[-8deg] transition-colors">
                    <span class="skew-x-[8deg]">Bize Ulaş</span>
                </a>
            </div>
        </div>
    </section>

</x-layouts.app>
