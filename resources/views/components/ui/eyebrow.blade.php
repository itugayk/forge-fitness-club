@props(['label', 'center' => false])

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-3 mb-4'.($center ? ' justify-center' : '')]) }}>
    <span class="h-px w-8 bg-volt-300"></span>
    <span class="text-volt-300 font-bold text-xs sm:text-sm uppercase tracking-[0.25em]">{{ $label }}</span>
    @if ($center)<span class="h-px w-8 bg-volt-300"></span>@endif
</div>
