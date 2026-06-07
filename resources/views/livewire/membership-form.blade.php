<div class="relative">
    @if ($submitted)
        {{-- ===================== SUCCESS ===================== --}}
        <div class="max-w-xl mx-auto text-center bg-ink-3 border border-volt-300/30 p-10">
            <div class="grid place-items-center w-20 h-20 mx-auto bg-volt-300/15 rounded-full mb-6">
                <x-heroicon-s-check class="w-11 h-11 text-volt-300" />
            </div>
            <h2 class="font-display text-4xl text-white uppercase">Başvurun Alındı!</h2>
            <p class="mt-4 text-zinc-300">Teşekkürler <span class="text-volt-300 font-semibold">{{ $name }}</span>!
                Ekibimiz en kısa sürede seninle iletişime geçecek. İlk antrenmanın bizden. 💪</p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('timetable') }}" class="bg-volt-300 hover:bg-volt-200 text-black font-bold uppercase tracking-wide px-6 py-3 skew-x-[-8deg]"><span class="block skew-x-[8deg]">Ders Programını Gör</span></a>
                <a href="{{ route('home') }}" class="border border-white/20 hover:border-volt-300 text-white font-bold uppercase tracking-wide px-6 py-3 skew-x-[-8deg]"><span class="block skew-x-[8deg]">Ana Sayfa</span></a>
            </div>
        </div>
    @else
        <form wire:submit="submit" class="grid lg:grid-cols-5 gap-8">
            {{-- LEFT: selection --}}
            <div class="lg:col-span-3 space-y-8">
                {{-- Step 1: plan --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="grid place-items-center w-7 h-7 bg-volt-300 text-black font-display text-sm">1</span>
                        <h3 class="font-display text-2xl text-white uppercase tracking-wide">Paketini Seç</h3>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach ($this->plans as $plan)
                            <button type="button" wire:click="selectPlan({{ $plan->id }})"
                                    class="text-left p-4 border transition-all relative
                                    {{ $selectedPlanId === $plan->id ? 'border-volt-300 bg-volt-300/10' : 'border-white/10 bg-ink-3 hover:border-white/25' }}">
                                @if ($selectedPlanId === $plan->id)
                                    <x-heroicon-s-check-circle class="w-5 h-5 text-volt-300 absolute top-3 right-3" />
                                @endif
                                <div class="font-display text-xl text-white uppercase tracking-wide">{{ $plan->name }}</div>
                                <div class="text-xs text-zinc-400">{{ $plan->tagline }}</div>
                                <div class="mt-2 text-volt-300 font-bold">₺{{ number_format($plan->priceFor($period), 0, ',', '.') }}
                                    <span class="text-zinc-500 text-xs font-normal">{{ ['monthly' => '/ay', 'quarterly' => '/3 ay', 'yearly' => '/yıl'][$period] }}</span>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @error('selectedPlanId') <p class="text-flame-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                {{-- Step 2: period --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="grid place-items-center w-7 h-7 bg-volt-300 text-black font-display text-sm">2</span>
                        <h3 class="font-display text-2xl text-white uppercase tracking-wide">Ödeme Periyodu</h3>
                    </div>
                    <div class="inline-flex bg-ink-3 border border-white/10 p-1 rounded-full">
                        @foreach (['monthly' => 'Aylık', 'quarterly' => '3 Aylık', 'yearly' => 'Yıllık'] as $key => $label)
                            <button type="button" wire:click="setPeriod('{{ $key }}')"
                                    class="px-5 sm:px-6 py-2.5 rounded-full text-sm font-bold uppercase tracking-wide transition-colors
                                    {{ $period === $key ? 'bg-volt-300 text-black' : 'text-zinc-400 hover:text-white' }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Step 3: info --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="grid place-items-center w-7 h-7 bg-volt-300 text-black font-display text-sm">3</span>
                        <h3 class="font-display text-2xl text-white uppercase tracking-wide">Bilgilerin</h3>
                    </div>
                    @php $inp = 'w-full bg-ink-3 border border-white/10 focus:border-volt-300 focus:ring-0 text-white placeholder-zinc-500 px-4 py-3 text-sm transition-colors'; @endphp
                    <div class="grid sm:grid-cols-2 gap-3">
                        <div class="sm:col-span-2">
                            <input type="text" wire:model="name" placeholder="Ad Soyad *" class="{{ $inp }}">
                            @error('name') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <input type="email" wire:model="email" placeholder="E-posta *" class="{{ $inp }}">
                            @error('email') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <input type="text" wire:model="phone" placeholder="Telefon *" class="{{ $inp }}">
                            @error('phone') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[11px] uppercase tracking-widest text-zinc-500 mb-1">Doğum Tarihi</label>
                            <input type="date" wire:model="birth_date" class="{{ $inp }}">
                            @error('birth_date') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[11px] uppercase tracking-widest text-zinc-500 mb-1">Hedefin</label>
                            <select wire:model="goal" class="{{ $inp }}">
                                <option value="">Seçiniz...</option>
                                @foreach (\App\Models\MembershipApplication::goals() as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <textarea wire:model="message" rows="3" placeholder="Eklemek istediğin not (opsiyonel)" class="{{ $inp }}"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: summary --}}
            <div class="lg:col-span-2">
                <div class="lg:sticky lg:top-24 bg-gradient-to-b from-volt-300/10 to-ink-3 border border-volt-300/30 p-6">
                    <h3 class="font-display text-2xl text-white uppercase tracking-wide mb-5">Özet</h3>
                    @if ($this->selectedPlan)
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between"><span class="text-zinc-400">Paket</span><span class="text-white font-bold">{{ $this->selectedPlan->name }}</span></div>
                            <div class="flex justify-between"><span class="text-zinc-400">Periyot</span><span class="text-white font-bold">{{ ['monthly' => 'Aylık', 'quarterly' => '3 Aylık', 'yearly' => 'Yıllık'][$period] }}</span></div>
                            @if ($period !== 'monthly')
                                <div class="flex justify-between"><span class="text-zinc-400">Aylık karşılığı</span><span class="text-volt-300">≈ ₺{{ number_format($this->selectedPlan->monthlyEquivalentFor($period), 0, ',', '.') }}/ay</span></div>
                            @endif
                            <div class="border-t border-white/10 pt-3 flex justify-between items-end">
                                <span class="text-zinc-400">Toplam</span>
                                <span class="font-display text-3xl text-volt-300">₺{{ number_format($this->selectedPlan->priceFor($period), 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <ul class="mt-5 space-y-2">
                            @foreach (array_slice($this->selectedPlan->features ?? [], 0, 5) as $f)
                                <li class="flex items-start gap-2 text-xs text-zinc-300"><x-heroicon-s-check class="w-4 h-4 text-volt-300 shrink-0 mt-px" />{{ $f }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-zinc-400">Lütfen bir paket seçin.</p>
                    @endif

                    <button type="submit"
                            class="w-full mt-6 bg-volt-300 hover:bg-volt-200 text-black font-extrabold uppercase tracking-wide px-5 py-4 transition-colors disabled:opacity-60"
                            wire:loading.attr="disabled" wire:target="submit">
                        <span wire:loading.remove wire:target="submit">Başvuruyu Gönder</span>
                        <span wire:loading wire:target="submit">Gönderiliyor...</span>
                    </button>
                    <p class="text-[11px] text-zinc-500 text-center mt-3">Demo başvuru · ödeme alınmaz, ekibimiz seni arar.</p>
                </div>
            </div>
        </form>
    @endif
</div>
