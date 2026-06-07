@props(['plans'])

<div x-data="{ period: 'monthly' }">
    {{-- Period toggle --}}
    <div class="flex justify-center mb-12">
        <div class="inline-flex bg-ink-3 border border-white/10 p-1 rounded-full">
            <template x-for="opt in [{k:'monthly',l:'Aylık'},{k:'quarterly',l:'3 Aylık'},{k:'yearly',l:'Yıllık'}]" :key="opt.k">
                <button
                    @click="period = opt.k"
                    :class="period === opt.k ? 'bg-volt-300 text-black' : 'text-zinc-400 hover:text-white'"
                    class="px-5 sm:px-7 py-2.5 rounded-full text-sm font-bold uppercase tracking-wide transition-colors"
                    x-text="opt.l"></button>
            </template>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-2 items-stretch">
        @foreach ($plans as $plan)
            @php
                $prices = [
                    'monthly' => '₺'.number_format($plan->price_monthly, 0, ',', '.'),
                    'quarterly' => '₺'.number_format($plan->price_quarterly, 0, ',', '.'),
                    'yearly' => '₺'.number_format($plan->price_yearly, 0, ',', '.'),
                ];
                $eqv = [
                    'quarterly' => '₺'.number_format($plan->monthlyEquivalentFor('quarterly'), 0, ',', '.').'/ay',
                    'yearly' => '₺'.number_format($plan->monthlyEquivalentFor('yearly'), 0, ',', '.').'/ay',
                ];
            @endphp
            <div class="relative flex flex-col p-7 border transition-all duration-300
                {{ $plan->is_featured
                    ? 'bg-gradient-to-b from-volt-300/10 to-ink-3 border-volt-300 lg:-translate-y-3 glow-volt'
                    : 'bg-ink-3 border-white/10 hover:border-white/25' }}">

                @if ($plan->is_featured)
                    <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-volt-300 text-black text-[11px] font-extrabold uppercase tracking-widest px-3 py-1 skew-x-[-8deg]">
                        <span class="block skew-x-[8deg]">En Popüler</span>
                    </span>
                @endif

                <h3 class="font-display text-3xl uppercase tracking-wide {{ $plan->is_featured ? 'text-volt-300' : 'text-white' }}">
                    {{ $plan->name }}
                </h3>
                <p class="text-sm text-zinc-400 mt-1 min-h-[20px]">{{ $plan->tagline }}</p>

                <div class="mt-6 mb-1">
                    <span class="font-display text-5xl text-white"
                          x-text="{ monthly:'{{ $prices['monthly'] }}', quarterly:'{{ $prices['quarterly'] }}', yearly:'{{ $prices['yearly'] }}' }[period]"></span>
                    <span class="text-zinc-400 text-sm font-medium"
                          x-text="{ monthly:'/ay', quarterly:'/3 ay', yearly:'/yıl' }[period]"></span>
                </div>
                <p class="text-xs text-volt-300 h-4 font-semibold"
                   x-text="{ monthly:'', quarterly:'≈ {{ $eqv['quarterly'] }}', yearly:'≈ {{ $eqv['yearly'] }}' }[period]"></p>

                <ul class="mt-6 space-y-3 flex-1">
                    @foreach ($plan->features ?? [] as $feature)
                        <li class="flex items-start gap-2.5 text-sm text-zinc-300">
                            <x-heroicon-s-check-circle class="w-5 h-5 text-volt-300 shrink-0 mt-px" />
                            <span>{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>

                <a :href="'{{ route('join') }}?plan={{ $plan->slug }}&period=' + period"
                   class="mt-7 block text-center font-bold uppercase tracking-wide text-sm px-5 py-3 transition-colors skew-x-[-8deg]
                   {{ $plan->is_featured
                        ? 'bg-volt-300 hover:bg-volt-200 text-black'
                        : 'bg-white/5 hover:bg-volt-300 hover:text-black text-white border border-white/15' }}">
                    <span class="block skew-x-[8deg]">Paketi Seç</span>
                </a>
            </div>
        @endforeach
    </div>
</div>
