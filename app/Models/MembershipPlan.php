<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MembershipPlan extends Model
{
    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
        'price_monthly' => 'decimal:2',
        'price_quarterly' => 'decimal:2',
        'price_yearly' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(MembershipApplication::class);
    }

    /** Seçilen periyoda göre toplam fiyatı döndürür. */
    public function priceFor(string $period): float
    {
        return (float) match ($period) {
            'quarterly' => $this->price_quarterly,
            'yearly' => $this->price_yearly,
            default => $this->price_monthly,
        };
    }

    /** Periyodun aylık karşılığı (tasarruf vurgusu için). */
    public function monthlyEquivalentFor(string $period): float
    {
        return match ($period) {
            'quarterly' => round($this->price_quarterly / 3, 2),
            'yearly' => round($this->price_yearly / 12, 2),
            default => (float) $this->price_monthly,
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('price_monthly');
    }

    public static function periods(): array
    {
        return [
            'monthly' => 'Aylık',
            'quarterly' => '3 Aylık',
            'yearly' => 'Yıllık',
        ];
    }
}
