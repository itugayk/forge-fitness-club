<x-layouts.app title="Ders Programı"
    description="Forge Fitness Club haftalık ders programı: yoga, pilates, CrossFit, spinning, HIIT ve daha fazlası. Dersini seç, kontenjanı gör, yerini anında ayır.">

    <x-page-hero
        eyebrow="Haftalık Program"
        title="Ders Programı"
        subtitle="Gününü ve saatini seç, dersin detayını incele ve canlı kontenjanla yerini hemen ayır."
        image="{{ \App\Support\DemoImage::unsplash('1518611012118-696072aa579a', 1600, 900) }}" />

    <section class="py-14 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:timetable />
        </div>
    </section>

</x-layouts.app>
