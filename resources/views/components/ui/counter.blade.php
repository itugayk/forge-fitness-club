@props(['value', 'label', 'suffix' => '', 'prefix' => ''])

<div class="text-center"
     x-data="{ n: 0, done: false }"
     x-init="
        let self = $data, target = {{ (int) $value }};
        new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !self.done) {
                self.done = true;
                let start = null, dur = 1600;
                let step = (ts) => {
                    if (!start) start = ts;
                    let p = Math.min((ts - start) / dur, 1);
                    self.n = Math.floor(p * target);
                    if (p < 1) requestAnimationFrame(step); else self.n = target;
                };
                requestAnimationFrame(step);
            }
        }, { threshold: 0.4 }).observe($el);
     ">
    <div class="font-display text-5xl lg:text-6xl text-volt-300 leading-none">
        <span>{{ $prefix }}</span><span x-text="n.toLocaleString('tr-TR')">0</span><span>{{ $suffix }}</span>
    </div>
    <div class="mt-2.5 text-xs sm:text-sm uppercase tracking-widest text-zinc-400">{{ $label }}</div>
</div>
