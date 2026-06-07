<x-layouts.app title="Eğitmenler"
    description="Forge Fitness Club'ın uzman antrenör kadrosu: CrossFit, yoga, pilates, kuvvet, spinning, dövüş sanatları ve beslenme uzmanları.">

    <x-page-hero
        eyebrow="Kadromuz"
        title="Eğitmenler"
        subtitle="Sertifikalı, deneyimli ve tutkulu. Seni hedefine taşıyacak ekiple tanış."
        image="{{ \App\Support\DemoImage::unsplash('1574680096145-d05b474e2155', 1600, 900) }}" />

    <section class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($trainers as $trainer)
                    <a href="{{ route('trainer.show', $trainer) }}"
                       class="group relative block overflow-hidden bg-ink-3 border border-white/10 hover:border-volt-300 transition-colors">
                        <div class="aspect-[4/5] overflow-hidden">
                            <img src="{{ $trainer->photo_url }}" alt="{{ $trainer->name }}"
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/40 to-transparent"></div>
                        <div class="absolute bottom-0 inset-x-0 p-6">
                            <p class="text-volt-300 text-xs font-bold uppercase tracking-widest">{{ $trainer->specialty }}</p>
                            <h3 class="font-display text-3xl text-white uppercase tracking-wide leading-none mt-1">{{ $trainer->name }}</h3>
                            <p class="text-sm text-zinc-300 mt-1">{{ $trainer->title }}</p>
                            <div class="flex items-center gap-4 mt-3 text-xs text-zinc-400">
                                <span class="inline-flex items-center gap-1.5"><x-heroicon-m-trophy class="w-4 h-4 text-volt-300" />{{ $trainer->years_experience }} yıl</span>
                                <span class="inline-flex items-center gap-1.5 text-volt-300 font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">Profili Gör <x-heroicon-m-arrow-long-right class="w-4 h-4" /></span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

</x-layouts.app>
