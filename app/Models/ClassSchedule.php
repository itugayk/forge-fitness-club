<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassSchedule extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'day_of_week' => 'integer',
        'capacity' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ClassCategory::class, 'class_category_id');
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(ClassBooking::class);
    }

    public function confirmedBookings(): HasMany
    {
        return $this->bookings()->where('status', 'confirmed');
    }

    /* ----------------------------------------------------------------
     | Kontenjan / dolu-boş hesapları
     * ---------------------------------------------------------------- */

    protected function bookedCount(): Attribute
    {
        return Attribute::get(fn () => $this->confirmed_bookings_count
            ?? $this->confirmedBookings()->count());
    }

    protected function remaining(): Attribute
    {
        return Attribute::get(fn () => max(0, $this->capacity - $this->booked_count));
    }

    protected function isFull(): Attribute
    {
        return Attribute::get(fn () => $this->remaining <= 0);
    }

    protected function fillPercent(): Attribute
    {
        return Attribute::get(fn () => $this->capacity > 0
            ? (int) round(($this->booked_count / $this->capacity) * 100)
            : 0);
    }

    /* ----------------------------------------------------------------
     | Etiketler
     * ---------------------------------------------------------------- */

    protected function startLabel(): Attribute
    {
        return Attribute::get(fn () => substr((string) $this->start_time, 0, 5));
    }

    protected function endLabel(): Attribute
    {
        return Attribute::get(fn () => substr((string) $this->end_time, 0, 5));
    }

    protected function dayName(): Attribute
    {
        return Attribute::get(fn () => self::days()[$this->day_of_week] ?? '');
    }

    protected function levelLabel(): Attribute
    {
        return Attribute::get(fn () => self::levels()[$this->level] ?? ucfirst($this->level));
    }

    public function durationMinutes(): int
    {
        return (int) ((strtotime($this->end_time) - strtotime($this->start_time)) / 60);
    }

    /* ----------------------------------------------------------------
     | Scopes & sözlükler
     * ---------------------------------------------------------------- */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function days(): array
    {
        return [
            1 => 'Pazartesi',
            2 => 'Salı',
            3 => 'Çarşamba',
            4 => 'Perşembe',
            5 => 'Cuma',
            6 => 'Cumartesi',
            7 => 'Pazar',
        ];
    }

    public static function dayShorts(): array
    {
        return [
            1 => 'Pzt',
            2 => 'Sal',
            3 => 'Çar',
            4 => 'Per',
            5 => 'Cum',
            6 => 'Cmt',
            7 => 'Paz',
        ];
    }

    public static function levels(): array
    {
        return [
            'baslangic' => 'Başlangıç',
            'orta' => 'Orta',
            'ileri' => 'İleri',
            'tum-seviyeler' => 'Tüm Seviyeler',
        ];
    }
}
