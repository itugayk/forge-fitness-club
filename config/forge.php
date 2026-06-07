<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Marka / İletişim Bilgileri
    |--------------------------------------------------------------------------
    | Forge Fitness Club kurumsal bilgileri. Frontend ve JSON-LD bu değerleri
    | kullanır.
    */

    'brand' => 'Forge Fitness Club',
    'tagline' => 'Gücünü Keşfet. Limitini Aş.',
    'description' => 'Forge Fitness Club; modern ekipman, grup dersleri, kişisel '
        .'antrenörlük ve beslenme danışmanlığıyla şehrin en enerjik spor kulübü.',

    'phone' => '+90 212 555 0 199',
    'whatsapp' => '+905555550199',
    'email' => 'merhaba@forgefitness.com',
    'address' => 'Bağdat Caddesi No:212',
    'district' => 'Kadıköy',
    'city' => 'İstanbul',
    'postal_code' => '34710',
    'country' => 'TR',
    'latitude' => 40.9806,
    'longitude' => 29.0566,

    'social' => [
        'instagram' => 'https://instagram.com/forgefitnessclub',
        'youtube' => 'https://youtube.com/@forgefitnessclub',
        'facebook' => 'https://facebook.com/forgefitnessclub',
        'tiktok' => 'https://tiktok.com/@forgefitnessclub',
    ],

    'hours' => [
        'Pazartesi - Cuma' => '06:00 – 23:00',
        'Cumartesi' => '08:00 – 22:00',
        'Pazar' => '09:00 – 20:00',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ana Sayfa Sayaçları (Counters)
    |--------------------------------------------------------------------------
    | Bazı sayaçlar canlı veriden hesaplanır (eğitmen, haftalık ders); bazıları
    | gösterim amaçlı taban değerlerdir.
    */

    'stats' => [
        'members_base' => 2480,   // aktif üye tabanı (+ canlı başvurular)
        'years' => 9,             // yıllık tecrübe
        'pt_sessions' => 18000,   // tamamlanan PT seansı
    ],
];
