<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassBooking extends Model
{
    protected $guarded = [];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id');
    }

    public static function statuses(): array
    {
        return [
            'confirmed' => 'Onaylandı',
            'attended' => 'Katıldı',
            'cancelled' => 'İptal',
        ];
    }
}
