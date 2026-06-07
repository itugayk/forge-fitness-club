<div class="relative">

    {{-- Category legend --}}
    <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mb-8">
        @foreach ($this->categories as $cat)
            <span class="inline-flex items-center gap-2 text-xs uppercase tracking-wide text-zinc-400">
                <span class="w-3 h-3 rounded-sm" style="background: {{ $cat->color }}"></span>{{ $cat->name }}
            </span>
        @endforeach
    </div>

    {{-- ===================== MOBILE: day tabs + list ===================== --}}
    <div class="lg:hidden">
        <div class="flex gap-2 overflow-x-auto pb-3 -mx-4 px-4">
            @foreach (\App\Models\ClassSchedule::days() as $num => $label)
                <button wire:click="selectDay({{ $num }})"
                        class="shrink-0 px-4 py-2.5 text-sm font-bold uppercase tracking-wide border transition-colors
                        {{ $selectedDay === $num ? 'bg-volt-300 text-black border-volt-300' : 'bg-ink-3 text-zinc-300 border-white/10' }}">
                    {{ \App\Models\ClassSchedule::dayShorts()[$num] }}
                    <span class="block text-[10px] font-normal opacity-70">{{ optional($this->schedules->get($num))->count() ?? 0 }} ders</span>
                </button>
            @endforeach
        </div>

        <div class="mt-4 space-y-3">
            @forelse ($this->schedules->get($selectedDay, collect()) as $schedule)
                <x-timetable-card :schedule="$schedule" />
            @empty
                <p class="text-center text-zinc-500 py-10">Bu gün için planlanmış ders yok.</p>
            @endforelse
        </div>
    </div>

    {{-- ===================== DESKTOP: weekly board ===================== --}}
    <div class="hidden lg:grid grid-cols-7 gap-3">
        @foreach (\App\Models\ClassSchedule::days() as $num => $label)
            <div>
                <div class="text-center pb-3 mb-3 border-b-2 {{ (int) now()->isoWeekday() === $num ? 'border-volt-300' : 'border-white/10' }}">
                    <div class="font-display text-lg uppercase tracking-wide {{ (int) now()->isoWeekday() === $num ? 'text-volt-300' : 'text-white' }}">{{ \App\Models\ClassSchedule::dayShorts()[$num] }}</div>
                    <div class="text-[11px] text-zinc-500 uppercase tracking-wide">{{ optional($this->schedules->get($num))->count() ?? 0 }} ders</div>
                </div>
                <div class="space-y-2.5">
                    @forelse ($this->schedules->get($num, collect()) as $schedule)
                        <x-timetable-card :schedule="$schedule" />
                    @empty
                        <p class="text-center text-xs text-zinc-600 py-6">—</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

    {{-- ===================== MODAL ===================== --}}
    @if ($this->openSchedule)
        @php $s = $this->openSchedule; $color = $s->category->color ?? '#c5ff3d'; @endphp
        <div class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center p-0 sm:p-4"
             wire:key="modal-{{ $s->id }}">
            <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" wire:click="closeModal"></div>

            <div class="relative w-full sm:max-w-lg bg-ink-2 border border-white/10 sm:border-volt-300/30 shadow-2xl max-h-[92vh] overflow-y-auto">
                <span class="absolute top-0 left-0 right-0 h-1.5" style="background: {{ $color }}"></span>

                <button wire:click="closeModal" class="absolute top-4 right-4 text-zinc-400 hover:text-white z-10">
                    <x-heroicon-o-x-mark class="w-6 h-6" />
                </button>

                <div class="p-6 sm:p-8">
                    <span class="inline-block text-xs font-bold uppercase tracking-widest px-2.5 py-1 rounded-sm mb-3"
                          style="color: {{ $color }}; background: {{ $color }}1a;">{{ $s->category->name }}</span>
                    <h3 class="font-display text-3xl text-white uppercase tracking-wide leading-none">{{ $s->title }}</h3>

                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="flex items-center gap-2.5 text-sm">
                            <x-heroicon-m-calendar-days class="w-5 h-5 text-volt-300" />
                            <span class="text-zinc-300">{{ $s->day_name }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-sm">
                            <x-heroicon-m-clock class="w-5 h-5 text-volt-300" />
                            <span class="text-zinc-300">{{ $s->start_label }} – {{ $s->end_label }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-sm">
                            <x-heroicon-m-user class="w-5 h-5 text-volt-300" />
                            <span class="text-zinc-300">{{ optional($s->trainer)->name ?? 'Forge Ekibi' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-sm">
                            <x-heroicon-m-academic-cap class="w-5 h-5 text-volt-300" />
                            <span class="text-zinc-300">{{ $s->level_label }}</span>
                        </div>
                        @if ($s->room)
                            <div class="flex items-center gap-2.5 text-sm col-span-2">
                                <x-heroicon-m-map-pin class="w-5 h-5 text-volt-300" />
                                <span class="text-zinc-300">{{ $s->room }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Capacity --}}
                    <div class="mt-6">
                        <div class="flex items-center justify-between text-xs uppercase tracking-wide mb-1.5">
                            <span class="text-zinc-400">Kontenjan</span>
                            <span class="font-bold {{ $s->is_full ? 'text-flame-400' : 'text-volt-300' }}">
                                {{ $s->is_full ? 'DOLU' : $s->remaining.' yer kaldı' }} · {{ $s->booked_count }}/{{ $s->capacity }}
                            </span>
                        </div>
                        <div class="h-2 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500 {{ $s->is_full ? 'bg-flame-400' : 'bg-volt-300' }}" style="width: {{ max(4, $s->fill_percent) }}%"></div>
                        </div>
                    </div>

                    <div class="border-t border-white/10 mt-6 pt-6">
                        @if ($booked)
                            {{-- Success state --}}
                            <div class="text-center py-4">
                                <div class="grid place-items-center w-16 h-16 mx-auto bg-volt-300/15 rounded-full mb-4">
                                    <x-heroicon-s-check class="w-9 h-9 text-volt-300" />
                                </div>
                                <h4 class="font-display text-2xl text-white uppercase">Yerin Ayrıldı!</h4>
                                <p class="text-sm text-zinc-400 mt-2">{{ $s->title }} dersine kaydın alındı.
                                    Görüşmek üzere, hazır ol! 🔥</p>
                                <button wire:click="closeModal" class="mt-5 text-sm font-bold uppercase tracking-widest text-volt-300 hover:text-volt-200">Kapat</button>
                            </div>
                        @elseif ($s->is_full)
                            <div class="text-center py-4">
                                <p class="text-flame-400 font-bold uppercase tracking-wide">Bu ders dolu</p>
                                <p class="text-sm text-zinc-400 mt-2">Başka bir seans seçerek yerini hemen ayırabilirsin.</p>
                            </div>
                        @else
                            {{-- Booking form --}}
                            <form wire:submit="book" class="space-y-3">
                                <p class="text-sm text-zinc-300 mb-1">Bu derse <span class="text-volt-300 font-semibold">ücretsiz</span> yer ayır:</p>
                                <div>
                                    <input type="text" wire:model="name" placeholder="Ad Soyad"
                                           class="w-full bg-ink-3 border border-white/10 focus:border-volt-300 focus:ring-0 text-white placeholder-zinc-500 px-4 py-3 text-sm transition-colors">
                                    @error('name') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <input type="email" wire:model="email" placeholder="E-posta"
                                           class="w-full bg-ink-3 border border-white/10 focus:border-volt-300 focus:ring-0 text-white placeholder-zinc-500 px-4 py-3 text-sm transition-colors">
                                    @error('email') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <input type="text" wire:model="phone" placeholder="Telefon (opsiyonel)"
                                           class="w-full bg-ink-3 border border-white/10 focus:border-volt-300 focus:ring-0 text-white placeholder-zinc-500 px-4 py-3 text-sm transition-colors">
                                    @error('phone') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <button type="submit"
                                        class="w-full bg-volt-300 hover:bg-volt-200 text-black font-extrabold uppercase tracking-wide px-5 py-3.5 transition-colors disabled:opacity-60"
                                        wire:loading.attr="disabled" wire:target="book">
                                    <span wire:loading.remove wire:target="book">Yerini Ayır</span>
                                    <span wire:loading wire:target="book">Kaydediliyor...</span>
                                </button>
                                <p class="text-[11px] text-zinc-500 text-center">Demo rezervasyon · ödeme alınmaz.</p>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
