@props(['schedule'])

@php
    $color = $schedule->category->color ?? '#c5ff3d';
    $full = $schedule->is_full;
@endphp

<button type="button" wire:click="openClass({{ $schedule->id }})" wire:key="cls-{{ $schedule->id }}"
        class="group w-full text-left bg-ink-3 border border-white/10 hover:border-volt-300/60 hover:-translate-y-0.5 p-4 transition-all relative overflow-hidden">
    <span class="absolute left-0 top-0 bottom-0 w-1" style="background: {{ $color }}"></span>
    <div class="flex items-center justify-between gap-2 pl-1">
        <span class="font-display text-lg text-white leading-none">{{ $schedule->start_label }}</span>
        <span class="text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 border rounded-sm"
              style="color: {{ $color }}; border-color: {{ $color }}40;">{{ $schedule->category->name }}</span>
    </div>
    <h4 class="mt-1.5 pl-1 font-bold text-white text-sm leading-tight group-hover:text-volt-300 transition-colors">{{ $schedule->title }}</h4>
    <p class="text-xs text-zinc-400 mt-0.5 pl-1">{{ optional($schedule->trainer)->name ?? 'Forge Ekibi' }}</p>

    <div class="mt-3 pl-1">
        <div class="flex items-center justify-between text-[10px] uppercase tracking-wide mb-1">
            @if ($full)
                <span class="text-flame-400 font-bold">Dolu</span>
            @else
                <span class="text-zinc-400">{{ $schedule->remaining }} yer kaldı</span>
            @endif
            <span class="text-zinc-500">{{ $schedule->booked_count }}/{{ $schedule->capacity }}</span>
        </div>
        <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
            <div class="h-full rounded-full {{ $full ? 'bg-flame-400' : 'bg-volt-300' }}" style="width: {{ max(4, $schedule->fill_percent) }}%"></div>
        </div>
    </div>
</button>
