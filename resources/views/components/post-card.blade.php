@props(['post'])

<a href="{{ route('blog.show', $post) }}"
   class="group flex flex-col bg-ink-3 border border-white/10 hover:border-volt-300 overflow-hidden transition-colors">
    <div class="aspect-[16/10] overflow-hidden">
        <img src="{{ $post->cover_url }}" alt="{{ $post->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </div>
    <div class="p-6 flex flex-col flex-1">
        <div class="flex items-center gap-3 text-xs text-zinc-400 mb-3">
            @if ($post->category)
                <span class="text-volt-300 font-bold uppercase tracking-widest">{{ $post->category }}</span>
                <span class="w-1 h-1 rounded-full bg-zinc-600"></span>
            @endif
            <span>{{ $post->reading_minutes }} dk okuma</span>
        </div>
        <h3 class="font-display text-xl text-white uppercase tracking-wide leading-snug group-hover:text-volt-300 transition-colors">
            {{ $post->title }}
        </h3>
        <p class="mt-2.5 text-sm text-zinc-400 leading-relaxed flex-1">{{ \Illuminate\Support\Str::limit($post->excerpt, 110) }}</p>
        <div class="mt-5 flex items-center justify-between text-xs text-zinc-500">
            <span>{{ optional($post->published_at)->translatedFormat('d M Y') }}</span>
            <span class="inline-flex items-center gap-1.5 text-volt-300 font-bold uppercase tracking-widest">
                Oku <x-heroicon-m-arrow-long-right class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
            </span>
        </div>
    </div>
</a>
