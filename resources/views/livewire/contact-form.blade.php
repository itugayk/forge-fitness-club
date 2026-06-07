<div>
    @php $inp = 'w-full bg-ink-3 border border-white/10 focus:border-volt-300 focus:ring-0 text-white placeholder-zinc-500 px-4 py-3 text-sm transition-colors'; @endphp

    @if ($submitted)
        <div class="bg-volt-300/10 border border-volt-300/40 p-5 mb-6 flex items-start gap-3">
            <x-heroicon-s-check-circle class="w-6 h-6 text-volt-300 shrink-0" />
            <div>
                <p class="text-white font-bold">Mesajın bize ulaştı!</p>
                <p class="text-sm text-zinc-300">En kısa sürede dönüş yapacağız. Teşekkürler.</p>
            </div>
        </div>
    @endif

    <form wire:submit="submit" class="space-y-4">
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <input type="text" wire:model="name" placeholder="Ad Soyad *" class="{{ $inp }}">
                @error('name') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="email" wire:model="email" placeholder="E-posta *" class="{{ $inp }}">
                @error('email') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="text" wire:model="phone" placeholder="Telefon" class="{{ $inp }}">
                @error('phone') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="text" wire:model="subject" placeholder="Konu" class="{{ $inp }}">
                @error('subject') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div>
            <textarea wire:model="message" rows="5" placeholder="Mesajın *" class="{{ $inp }}"></textarea>
            @error('message') <p class="text-flame-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <button type="submit"
                class="bg-volt-300 hover:bg-volt-200 text-black font-extrabold uppercase tracking-wide px-7 py-3.5 skew-x-[-8deg] transition-colors disabled:opacity-60"
                wire:loading.attr="disabled" wire:target="submit">
            <span class="block skew-x-[8deg]">
                <span wire:loading.remove wire:target="submit">Mesajı Gönder</span>
                <span wire:loading wire:target="submit">Gönderiliyor...</span>
            </span>
        </button>
    </form>
</div>
