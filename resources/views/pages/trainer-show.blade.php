<x-layouts.app :title="$trainer->name" :description="$trainer->title.' · '.$trainer->specialty" :og-image="$trainer->photo_url">

    <section class="relative pt-32 lg:pt-44 pb-16 lg:pb-20 overflow-hidden bg-ink">
        <div class="absolute inset-0">
            <img src="{{ $trainer->photo_url }}" alt="" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/85 to-ink/70"></div>
            <div class="absolute inset-0 bg-grid opacity-30"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('trainers') }}" class="inline-flex items-center gap-1.5 text-sm text-zinc-400 hover:text-volt-300 mb-8">
                <x-heroicon-m-arrow-long-left class="w-5 h-5" /> Tüm Eğitmenler
            </a>
            <div class="grid lg:grid-cols-3 gap-10 items-start">
                <div class="lg:col-span-1">
                    <div class="relative overflow-hidden border border-volt-300/30">
                        <img src="{{ $trainer->photo_url }}" alt="{{ $trainer->name }}" class="w-full aspect-[4/5] object-cover">
                    </div>
                    @if ($trainer->instagram)
                        <a href="{{ $trainer->instagram }}" target="_blank" rel="noopener"
                           class="mt-4 inline-flex items-center gap-2 text-sm text-zinc-300 hover:text-volt-300">
                            <x-heroicon-m-link class="w-4 h-4" /> Instagram
                        </a>
                    @endif
                </div>
                <div class="lg:col-span-2">
                    <p class="text-volt-300 font-bold text-sm uppercase tracking-[0.25em]">{{ $trainer->specialty }}</p>
                    <h1 class="font-display text-5xl lg:text-7xl text-white uppercase leading-[0.9] mt-2">{{ $trainer->name }}</h1>
                    <p class="text-lg text-zinc-300 mt-2">{{ $trainer->title }}</p>

                    <div class="flex flex-wrap gap-6 mt-6">
                        <div>
                            <div class="font-display text-3xl text-volt-300">{{ $trainer->years_experience }}</div>
                            <div class="text-xs uppercase tracking-widest text-zinc-400">Yıl Tecrübe</div>
                        </div>
                        <div>
                            <div class="font-display text-3xl text-volt-300">{{ $trainer->schedules->count() }}</div>
                            <div class="text-xs uppercase tracking-widest text-zinc-400">Haftalık Ders</div>
                        </div>
                    </div>

                    @if ($trainer->bio)
                        <p class="mt-6 text-zinc-300 leading-relaxed">{{ $trainer->bio }}</p>
                    @endif

                    @if ($trainer->certifications)
                        <div class="mt-6">
                            <h3 class="text-xs uppercase tracking-widest text-zinc-500 mb-3">Sertifikalar</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($trainer->certifications as $cert)
                                    <span class="text-xs font-semibold uppercase tracking-wide px-3 py-1.5 bg-ink-3 border border-white/10 text-zinc-300">{{ $cert }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <a href="{{ route('join') }}" class="inline-flex items-center gap-2 mt-8 bg-volt-300 hover:bg-volt-200 text-black font-bold uppercase tracking-wide px-6 py-3 skew-x-[-8deg] transition-colors">
                        <span class="block skew-x-[8deg]">Bu Eğitmenle Çalış</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Trainer's classes --}}
    @if ($trainer->schedules->isNotEmpty())
        <section class="py-16 lg:py-20 border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <x-ui.eyebrow label="Programı" />
                <h2 class="font-display text-3xl sm:text-4xl text-white uppercase leading-none mb-8">{{ $trainer->name }} ile Dersler</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($trainer->schedules as $s)
                        @php $color = $s->category->color ?? '#c5ff3d'; @endphp
                        <a href="{{ route('timetable') }}" class="block bg-ink-3 border border-white/10 hover:border-volt-300/50 p-4 relative overflow-hidden transition-colors">
                            <span class="absolute left-0 top-0 bottom-0 w-1" style="background: {{ $color }}"></span>
                            <div class="flex items-center justify-between pl-1">
                                <span class="text-sm font-bold text-white">{{ $s->day_name }}</span>
                                <span class="text-xs text-zinc-400">{{ $s->start_label }}–{{ $s->end_label }}</span>
                            </div>
                            <h4 class="font-bold text-white mt-1 pl-1">{{ $s->title }}</h4>
                            <span class="text-[10px] uppercase tracking-widest font-bold pl-1" style="color: {{ $color }}">{{ $s->category->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Related trainers --}}
    @if ($related->isNotEmpty())
        <section class="py-16 lg:py-20 bg-ink-2 border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-display text-3xl text-white uppercase mb-8">Diğer Eğitmenler</h2>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach ($related as $t)
                        <a href="{{ route('trainer.show', $t) }}" class="group relative block overflow-hidden border border-white/10 hover:border-volt-300 transition-colors">
                            <div class="aspect-[4/5] overflow-hidden">
                                <img src="{{ $t->photo_url }}" alt="{{ $t->name }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-ink to-transparent"></div>
                            <div class="absolute bottom-0 p-5">
                                <p class="text-volt-300 text-xs font-bold uppercase tracking-widest">{{ $t->specialty }}</p>
                                <h3 class="font-display text-2xl text-white uppercase leading-none mt-1">{{ $t->name }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</x-layouts.app>
