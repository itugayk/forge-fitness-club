<?php

namespace Database\Seeders;

use App\Models\Trainer;
use App\Support\DemoImage;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        $trainers = [
            [
                'name' => 'Mert Kaya', 'slug' => 'mert-kaya',
                'title' => 'Baş Antrenör', 'specialty' => 'CrossFit & Fonksiyonel',
                'years_experience' => 11, 'photo' => DemoImage::portrait('men', 32),
                'certifications' => ['CrossFit Level 2', 'NSCA-CSCS', 'TRX'],
                'instagram' => 'https://instagram.com/mertkaya',
                'bio' => 'Forge\'un kurucu antrenörü. 11 yıllık deneyimiyle yüzlerce sporcuyu '
                    .'ilk şınavından ilk yarışına taşıdı. Felsefesi basit: tutarlılık her şeyi yener.',
            ],
            [
                'name' => 'Elif Demir', 'slug' => 'elif-demir',
                'title' => 'Yoga & Pilates Eğitmeni', 'specialty' => 'Vinyasa & Hatha Yoga',
                'years_experience' => 8, 'photo' => DemoImage::portrait('women', 44),
                'certifications' => ['RYT-500', 'Mat Pilates', 'Nefes Koçluğu'],
                'instagram' => 'https://instagram.com/elifdemiryoga',
                'bio' => 'Hareketi meditasyonla buluşturuyor. Derslerinde güç ve sükuneti aynı '
                    .'akışta deneyimlersiniz.',
            ],
            [
                'name' => 'Burak Şahin', 'slug' => 'burak-sahin',
                'title' => 'Kuvvet & Kondisyon Koçu', 'specialty' => 'Powerlifting & Hipertrofi',
                'years_experience' => 13, 'photo' => DemoImage::portrait('men', 45),
                'certifications' => ['IPF Hakem', 'NASM-PES', 'Olimpik Halter'],
                'instagram' => 'https://instagram.com/buraklifts',
                'bio' => 'Milli powerlifting geçmişiyle bara saygıyı öğretiyor. Doğru teknik, '
                    .'akıllı programlama ve sabır.',
            ],
            [
                'name' => 'Zeynep Arslan', 'slug' => 'zeynep-arslan',
                'title' => 'Spinning & Kardiyo Eğitmeni', 'specialty' => 'Indoor Cycling & HIIT',
                'years_experience' => 6, 'photo' => DemoImage::portrait('women', 68),
                'certifications' => ['Schwinn Cycling', 'Les Mills RPM', 'First Aid'],
                'instagram' => 'https://instagram.com/zeynepride',
                'bio' => 'Playlist\'i kadar enerjik. Pedalları çevirirken sınırlarınızı nasıl '
                    .'aşacağınızı gösteriyor.',
            ],
            [
                'name' => 'Can Yıldız', 'slug' => 'can-yildiz',
                'title' => 'Dövüş Sanatları Eğitmeni', 'specialty' => 'Boks & Kickbox',
                'years_experience' => 9, 'photo' => DemoImage::portrait('men', 12),
                'certifications' => ['WAKO Antrenör', 'Boks Milli Takım', 'Kondisyon'],
                'instagram' => 'https://instagram.com/canfights',
                'bio' => 'Ringde geçen yıllarını sahaya taşıyor. Teknik, refleks ve özgüven '
                    .'aynı seansta.',
            ],
            [
                'name' => 'Selin Aydın', 'slug' => 'selin-aydin',
                'title' => 'Pilates & Mobilite Uzmanı', 'specialty' => 'Reformer Pilates',
                'years_experience' => 7, 'photo' => DemoImage::portrait('women', 25),
                'certifications' => ['BASI Pilates', 'Mobility Specialist', 'Rehab Pilates'],
                'instagram' => 'https://instagram.com/selinpilates',
                'bio' => 'Masa başı ağrılarına çözüm üretiyor. Derinlemesine core ve postür '
                    .'çalışmasının ustası.',
            ],
            [
                'name' => 'Deniz Korkmaz', 'slug' => 'deniz-korkmaz',
                'title' => 'HIIT & Metabolik Antrenör', 'specialty' => 'Metcon & Yağ Yakımı',
                'years_experience' => 5, 'photo' => DemoImage::portrait('men', 76),
                'certifications' => ['ACE-CPT', 'Kettlebell L1', 'HIIT Specialist'],
                'instagram' => 'https://instagram.com/denizburn',
                'bio' => '40 dakikada terletmeyi iş edinmiş. Yoğun ama akıllı; her seans bir '
                    .'sonrakine motivasyon.',
            ],
            [
                'name' => 'Aslı Yılmaz', 'slug' => 'asli-yilmaz',
                'title' => 'Beslenme & Wellness Koçu', 'specialty' => 'Sporcu Beslenmesi',
                'years_experience' => 10, 'photo' => DemoImage::portrait('women', 90),
                'certifications' => ['Diyetisyen (MSc)', 'ISSN Sports Nutrition', 'Wellness Coach'],
                'instagram' => 'https://instagram.com/aslinutrition',
                'bio' => 'Antrenmanın yarısı mutfakta kazanılır. Sürdürülebilir, gerçek hayata '
                    .'uyan beslenme planları kuruyor.',
            ],
        ];

        foreach ($trainers as $i => $t) {
            Trainer::updateOrCreate(['slug' => $t['slug']], $t + ['is_active' => true, 'sort_order' => $i]);
        }
    }
}
