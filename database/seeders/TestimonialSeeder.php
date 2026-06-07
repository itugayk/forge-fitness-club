<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Support\DemoImage;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Ozan Tunç', 'role' => 'Üye · 2 yıl', 'rating' => 5,
                'avatar' => DemoImage::portrait('men', 51),
                'content' => 'Forge\'a geldiğimde 10 dakika koşamıyordum. Bugün ilk yarı maratonumu '
                    .'tamamladım. Eğitmenlerin ilgisi ve enerjisi gerçekten fark yaratıyor.',
            ],
            [
                'name' => 'Merve Şen', 'role' => 'Performans Üyesi', 'rating' => 5,
                'avatar' => DemoImage::portrait('women', 33),
                'content' => 'Grup dersleri bağımlılık yapıyor! Spinning ve reformer pilates '
                    .'rutinim oldu. 6 ayda hem formuma kavuştum hem de harika bir topluluk buldum.',
            ],
            [
                'name' => 'Kerem Aksoy', 'role' => 'Elite Üyesi · 3 yıl', 'rating' => 5,
                'avatar' => DemoImage::portrait('men', 64),
                'content' => 'Birebir PT ve beslenme desteğiyle 14 kilo verdim, kas kütlemi korudum. '
                    .'Burada sayılar değil, alışkanlıklar değişiyor. Tavsiyem net: bir deneyin.',
            ],
            [
                'name' => 'Buse Eren', 'role' => 'Üye · 1 yıl', 'rating' => 5,
                'avatar' => DemoImage::portrait('women', 71),
                'content' => 'Masa başı işten gelen sırt ağrılarım pilates ve mobilite dersleriyle '
                    .'tamamen geçti. Selin hoca işinin gerçekten ustası.',
            ],
            [
                'name' => 'Emre Çelik', 'role' => 'CrossFit Üyesi', 'rating' => 5,
                'avatar' => DemoImage::portrait('men', 86),
                'content' => 'Ekipman kalitesi ve salonun temizliği üst seviye. WOD sonrası sauna '
                    .'tam bir ödül. Şehirdeki en iyi fonksiyonel alan burada.',
            ],
            [
                'name' => 'Derya Yalçın', 'role' => 'Başlangıç Üyesi', 'rating' => 4,
                'avatar' => DemoImage::portrait('women', 12),
                'content' => 'Spora yeni başlayan biri olarak çekiniyordum ama ilk günden kendimi '
                    .'evimde hissettim. Başlangıç değerlendirmesi tam isabetti.',
            ],
        ];

        foreach ($items as $i => $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name']],
                $t + ['is_active' => true, 'sort_order' => $i]
            );
        }
    }
}
