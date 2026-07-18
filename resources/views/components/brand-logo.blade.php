{{-- resources/views/components/brand-logo.blade.php
     Logo teks "MediaVerse" pengganti logo Laravel bawaan.
     "Media" = biru tua (--navy-deep), "Verse" = kuning keemasan (--accent-gold).
     Dipakai di: layouts/navigation.blade.php (navbar) & layouts/guest.blade.php (auth). --}}
@props(['size' => 'fs-4'])

<a href="{{ route('home') }}" {{ $attributes->merge(['class' => "brand-logo $size"]) }}>
    <span class="brand-logo-media">Media</span><span class="brand-logo-verse">Verse</span>
</a>
