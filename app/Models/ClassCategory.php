<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassCategory extends Model
{
    protected $guarded = [];

    public function schedules(): HasMany
    {
        return $this->hasMany(ClassSchedule::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
