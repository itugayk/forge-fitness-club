<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media
{
    /**
     * Resolve a stored media value to a usable URL.
     *
     * Admin uploads are stored on the "public" disk (a relative path), while
     * seeded demo content uses absolute (Unsplash/CDN) URLs. This handles both
     * transparently so views can always use the returned value in <img src>.
     */
    public static function url(?string $value, ?string $fallback = null): ?string
    {
        if (blank($value)) {
            return $fallback;
        }

        if (Str::startsWith($value, ['http://', 'https://', '/'])) {
            return $value;
        }

        return Storage::disk('public')->url($value);
    }
}
