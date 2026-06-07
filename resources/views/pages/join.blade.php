<x-layouts.app title="Üye Ol"
    description="Forge Fitness Club üyeliğine başla. Paketini seç, bilgilerini gir, ilk antrenmanın bizden.">

    <x-page-hero
        eyebrow="Üyelik"
        title="Hadi Başlayalım"
        subtitle="Paketini seç, formu doldur. Ekibimiz seni arayıp ilk ücretsiz antrenmanını planlasın."
        image="{{ \App\Support\DemoImage::unsplash('1583454110551-21f2fa2afe61', 1600, 900) }}" />

    <section class="py-16 lg:py-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:membership-form :plan="$selectedPlan" :period="$selectedPeriod" />
        </div>
    </section>

</x-layouts.app>
