<x-layouts.app title="Blog"
    description="Antrenman, beslenme ve sağlıklı yaşam üzerine Forge Fitness Club uzmanlarından ipuçları ve rehberler.">

    <x-page-hero
        eyebrow="Blog"
        title="Bilgiyle Güçlen"
        subtitle="Antrenman, beslenme ve yaşam tarzı üzerine uzmanlarımızdan rehberler."
        image="{{ \App\Support\DemoImage::unsplash('1605296867304-46d5465a13f1', 1600, 900) }}" />

    <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($posts->isEmpty())
                <p class="text-center text-zinc-500 py-16">Henüz yazı yok.</p>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

</x-layouts.app>
