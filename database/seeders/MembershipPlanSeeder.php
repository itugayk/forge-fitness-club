<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Öğrenci', 'slug' => 'ogrenci',
                'tagline' => 'Geçerli öğrenci kimliğiyle',
                'price_monthly' => 549, 'price_quarterly' => 1449, 'price_yearly' => 4990,
                'is_featured' => false,
                'features' => [
                    'Sınırsız gym erişimi (off-peak)',
                    'Haftada 3 grup dersi',
                    'Soyunma odası & duş',
                    'Mobil uygulama',
                ],
            ],
            [
                'name' => 'Başlangıç', 'slug' => 'baslangic',
                'tagline' => 'Yolculuğa ilk adım',
                'price_monthly' => 749, 'price_quarterly' => 1999, 'price_yearly' => 6990,
                'is_featured' => false,
                'features' => [
                    'Sınırsız gym erişimi (7/24)',
                    'Haftada 5 grup dersi',
                    'Ücretsiz fitness değerlendirmesi',
                    'Soyunma odası & duş',
                    'Mobil uygulama & ders rezervasyonu',
                ],
            ],
            [
                'name' => 'Performans', 'slug' => 'performans',
                'tagline' => 'En çok tercih edilen',
                'price_monthly' => 1149, 'price_quarterly' => 2999, 'price_yearly' => 9990,
                'is_featured' => true,
                'features' => [
                    'Başlangıç paketindeki her şey',
                    'SINIRSIZ tüm grup dersleri',
                    'Ayda 2 birebir PT seansı',
                    'InBody vücut analizi (aylık)',
                    'Misafir getirme hakkı (2/ay)',
                    'Öncelikli ders rezervasyonu',
                ],
            ],
            [
                'name' => 'Elite', 'slug' => 'elite',
                'tagline' => 'Sınırları kaldır',
                'price_monthly' => 1799, 'price_quarterly' => 4799, 'price_yearly' => 15990,
                'is_featured' => false,
                'features' => [
                    'Performans paketindeki her şey',
                    'Ayda 8 birebir PT seansı',
                    'Kişiye özel beslenme programı',
                    'Sauna & masaj erişimi',
                    'Havlu & kıyafet hizmeti',
                    'Sınırsız misafir hakkı',
                ],
            ],
        ];

        foreach ($plans as $i => $p) {
            MembershipPlan::updateOrCreate(['slug' => $p['slug']], $p + ['is_active' => true, 'sort_order' => $i]);
        }
    }
}
