<?php

namespace App\Support;

class DemoImage
{
    /** Boyutlandırılmış Unsplash CDN görsel URL'i üretir. */
    public static function unsplash(string $id, int $w = 900, int $h = 1100): string
    {
        return "https://images.unsplash.com/photo-{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";
    }

    /** randomuser.me portre URL'i (eğitmen / üye avatarları). */
    public static function portrait(string $gender, int $n): string
    {
        return "https://randomuser.me/api/portraits/{$gender}/{$n}.jpg";
    }
}
