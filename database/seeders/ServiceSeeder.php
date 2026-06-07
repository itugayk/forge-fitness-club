<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Support\DemoImage;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Gym & Serbest Antrenman', 'slug' => 'gym',
                'icon' => 'heroicon-o-bolt',
                'short_description' => '2.000 m² alan, premium ekipman, 7/24 erişim.',
                'description' => 'Hammer Strength ve Technogym ekipmanlarıyla donatılmış kuvvet '
                    .'bölgesi, geniş serbest ağırlık alanı ve fonksiyonel rig. Dilediğin saatte gel, '
                    .'kendi programını uygula.',
                'features' => ['Premium ekipman', '7/24 erişim', 'Serbest ağırlık alanı', 'Kardiyo bölgesi'],
                'image' => DemoImage::unsplash('1534438327276-14e5300c3a48', 1000, 700),
            ],
            [
                'title' => 'Grup Dersleri', 'slug' => 'grup-dersleri',
                'icon' => 'heroicon-o-users',
                'short_description' => 'Yoga, pilates, CrossFit, spinning ve daha fazlası.',
                'description' => 'Haftada 50+ ders. Enerjini paylaş, motivasyonunu yükselt. '
                    .'Başlangıçtan ileri seviyeye kadar her seviyeye uygun, uzman eğitmenler eşliğinde.',
                'features' => ['Haftada 50+ ders', 'Tüm seviyeler', 'Uzman eğitmenler', 'Online rezervasyon'],
                'image' => DemoImage::unsplash('1571019613454-1cb2f99b2d8b', 1000, 700),
            ],
            [
                'title' => 'Kişisel Antrenörlük', 'slug' => 'kisisel-antrenorluk',
                'icon' => 'heroicon-o-user',
                'short_description' => 'Sana özel program, birebir takip, hızlı sonuç.',
                'description' => 'Hedefini söyle, gerisini bize bırak. Sertifikalı PT\'lerimiz sana '
                    .'özel program tasarlar, her seansta tekniğini düzeltir ve seni hesap verebilir tutar.',
                'features' => ['Kişiye özel program', 'Birebir takip', 'Teknik düzeltme', 'Periyodik ölçüm'],
                'image' => DemoImage::unsplash('1517836357463-d25dfeac3438', 1000, 700),
            ],
            [
                'title' => 'Beslenme Danışmanlığı', 'slug' => 'beslenme',
                'icon' => 'heroicon-o-academic-cap',
                'short_description' => 'Diyetisyen kontrolünde sürdürülebilir planlar.',
                'description' => 'Antrenmanın yarısı mutfakta kazanılır. Uzman diyetisyenimiz '
                    .'yaşam tarzına uyan, gerçekçi ve sürdürülebilir beslenme planları hazırlar.',
                'features' => ['Diyetisyen kontrolü', 'InBody analizi', 'Sürdürülebilir plan', 'Aylık revizyon'],
                'image' => DemoImage::unsplash('1576678927484-cc907957088c', 1000, 700),
            ],
            [
                'title' => 'Fonksiyonel Bölge', 'slug' => 'fonksiyonel-bolge',
                'icon' => 'heroicon-o-fire',
                'short_description' => 'Sled, rope, kettlebell — gerçek güç burada.',
                'description' => 'Astroturf koşu şeridi, battle rope, kettlebell ve sled ile '
                    .'donatılmış 300 m² fonksiyonel alan. WOD\'larını burada tamamla.',
                'features' => ['Astroturf şerit', 'Battle rope', 'Kettlebell seti', 'Sled & tire'],
                'image' => DemoImage::unsplash('1581009146145-b5ef050c2e1e', 1000, 700),
            ],
            [
                'title' => 'Recovery & Wellness', 'slug' => 'recovery',
                'icon' => 'heroicon-o-sparkles',
                'short_description' => 'Sauna, masaj ve mobilite ile toparlan.',
                'description' => 'Performansın kadar toparlanman da önemli. Sauna, spor masajı ve '
                    .'rehberli mobilite seanslarıyla kaslarını yenile, sakatlığı önle.',
                'features' => ['Finlandiya saunası', 'Spor masajı', 'Mobilite seansları', 'Germe alanı'],
                'image' => DemoImage::unsplash('1540497077202-7c8a3999166f', 1000, 700),
            ],
        ];

        foreach ($services as $i => $s) {
            Service::updateOrCreate(['slug' => $s['slug']], $s + ['is_active' => true, 'sort_order' => $i]);
        }
    }
}
