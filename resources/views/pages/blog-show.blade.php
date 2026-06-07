<x-layouts.app :title="$post->title" :description="$post->excerpt" :og-image="$post->cover_url">

    <article>
        {{-- Hero --}}
        <header class="relative pt-32 lg:pt-44 pb-14 overflow-hidden bg-ink">
            <div class="absolute inset-0">
                <img src="{{ $post->cover_url }}" alt="" class="w-full h-full object-cover opacity-25">
                <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/85 to-ink/60"></div>
            </div>
            <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-sm text-zinc-400 hover:text-volt-300 mb-6">
                    <x-heroicon-m-arrow-long-left class="w-5 h-5" /> Tüm Yazılar
                </a>
                <div class="flex items-center gap-3 text-xs text-zinc-400 mb-4">
                    @if ($post->category)<span class="text-volt-300 font-bold uppercase tracking-widest">{{ $post->category }}</span><span class="w-1 h-1 rounded-full bg-zinc-600"></span>@endif
                    <span>{{ $post->reading_minutes }} dk okuma</span>
                    <span class="w-1 h-1 rounded-full bg-zinc-600"></span>
                    <span>{{ optional($post->published_at)->translatedFormat('d F Y') }}</span>
                </div>
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white uppercase leading-[0.95]">{{ $post->title }}</h1>
                @if ($post->author)
                    <p class="mt-5 text-sm text-zinc-400">Yazar: <span class="text-zinc-200 font-semibold">{{ $post->author }}</span></p>
                @endif
            </div>
        </header>

        {{-- Body --}}
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="relative aspect-[16/9] overflow-hidden mb-10 border border-white/10">
                <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
            @if ($post->excerpt)
                <p class="text-xl text-zinc-200 leading-relaxed border-l-2 border-volt-300 pl-5 mb-8">{{ $post->excerpt }}</p>
            @endif
            <div class="article">
                {!! $post->body !!}
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex items-center justify-between">
                <a href="{{ route('blog') }}" class="text-sm font-bold uppercase tracking-widest text-volt-300 hover:gap-2 inline-flex items-center gap-1.5">
                    <x-heroicon-m-arrow-long-left class="w-5 h-5" /> Bloga Dön
                </a>
                <a href="{{ route('join') }}" class="bg-volt-300 hover:bg-volt-200 text-black font-bold uppercase tracking-wide text-sm px-5 py-2.5 skew-x-[-8deg]"><span class="block skew-x-[8deg]">Üye Ol</span></a>
            </div>
        </div>
    </article>

    {{-- Related --}}
    @if ($related->isNotEmpty())
        <section class="py-16 bg-ink-2 border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-display text-3xl text-white uppercase mb-8">İlgili Yazılar</h2>
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ($related as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</x-layouts.app>
