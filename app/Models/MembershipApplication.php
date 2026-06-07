<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MembershipApplication extends Model
{
    protected $guarded = [];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(MembershipPlan::class, 'membership_plan_id');
    }

    public static function statuses(): array
    {
        return [
            'new' => 'Yeni',
            'contacted' => 'İletişim Kuruldu',
            'approved' => 'Onaylandı',
            'rejected' => 'Reddedildi',
        ];
    }

    public static function goals(): array
    {
        return [
            'kilo-verme' => 'Kilo Verme',
            'kas-kazanimi' => 'Kas Kazanımı',
            'kondisyon' => 'Kondisyon & Dayanıklılık',
            'esneklik' => 'Esneklik & Mobilite',
            'genel-saglik' => 'Genel Sağlık',
        ];
    }
}
