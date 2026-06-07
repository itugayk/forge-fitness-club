<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Support\DemoImage;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $p = fn (string $text) => '<p>'.$text.'</p>';

        $posts = [
            [
                'title' => 'Yeni Başlayanlar İçin İlk 30 Gün Rehberi',
                'category' => 'Antrenman', 'author' => 'Mert Kaya', 'reading_minutes' => 6,
                'cover' => '1547919307-1ecb10702e6f', 'days_ago' => 3,
                'excerpt' => 'Spora ilk adımı atarken bunalmana gerek yok. İşte ilk ayında '
                    .'seni motive tutacak ve sakatlıktan koruyacak basit bir yol haritası.',
                'body' => $p('Spora başlamanın en zor kısmı kapıdan içeri girmektir. İlk 30 gün, '
                        .'mükemmel olmakla değil; tutarlılık alışkanlığını inşa etmekle ilgilidir.')
                    .$p('<strong>Hafta 1-2:</strong> Haftada 3 gün, düşük yoğunlukta tam vücut '
                        .'antrenmanı. Amaç hareket kalıplarını öğrenmek. <strong>Hafta 3-4:</strong> '
                        .'Yoğunluğu kademeli artır, bir grup dersi ekle.')
                    .$p('Unutma: az ama düzenli, çok ama düzensizden her zaman üstündür.'),
            ],
            [
                'title' => 'Antrenman Öncesi ve Sonrası Ne Yemeli?',
                'category' => 'Beslenme', 'author' => 'Aslı Yılmaz', 'reading_minutes' => 5,
                'cover' => '1518310383802-640c2de311b2', 'days_ago' => 8,
                'excerpt' => 'Performansını ikiye katlamanın yolu mutfaktan geçiyor. '
                    .'Doğru zamanlama ve doğru besinlerle enerjini zirvede tut.',
                'body' => $p('Antrenmandan 1-2 saat önce kompleks karbonhidrat ve orta düzeyde '
                        .'protein içeren bir öğün enerji depolarını doldurur: yulaf + meyve, '
                        .'tam tahıllı ekmek + yumurta gibi.')
                    .$p('Antrenman sonrası 45 dakikalık "anabolik pencere" abartılsa da, '
                        .'protein ve karbonhidratı birlikte almak toparlanmayı hızlandırır.')
                    .$p('Su tüketimini gün boyu unutma; %2 dehidrasyon bile performansını düşürür.'),
            ],
            [
                'title' => 'Yağ Yakımında HIIT mi Kardiyo mu?',
                'category' => 'Antrenman', 'author' => 'Deniz Korkmaz', 'reading_minutes' => 7,
                'cover' => '1550345332-09e3ac987658', 'days_ago' => 14,
                'excerpt' => 'Sonsuz tartışmaya bilimsel bir bakış: zamanı kısıtlıysa hangisi '
                    .'daha verimli, ikisini nasıl birleştirmelisin?',
                'body' => $p('HIIT, kısa sürede yüksek kalori yakar ve "afterburn" (EPOC) etkisiyle '
                        .'antrenman sonrası da metabolizmayı yüksek tutar.')
                    .$p('Düşük tempolu uzun kardiyo ise toparlanması kolaydır ve dayanıklılık tabanı '
                        .'kurar. İdeal yaklaşım: haftada 2 HIIT + 1-2 düşük tempolu kardiyo.')
                    .$p('Hangisini seçersen seç, sürdürebildiğin program en iyi programdır.'),
            ],
            [
                'title' => 'Reformer Pilates Postürünü Nasıl Düzeltir?',
                'category' => 'Wellness', 'author' => 'Selin Aydın', 'reading_minutes' => 4,
                'cover' => '1546483875-ad9014c88eba', 'days_ago' => 21,
                'excerpt' => 'Masa başı çalışanların kabusu kötü postür. Reformer pilatesin '
                    .'derin kas çalışmasıyla nasıl dik durabileceğini anlatıyoruz.',
                'body' => $p('Uzun saatler oturmak kalça fleksörlerini kısaltır, sırt kaslarını '
                        .'zayıflatır. Reformer, kontrollü direnç altında bu dengesizliği hedefler.')
                    .$p('Core stabilizasyonu, omurga hizalaması ve nefes kontrolü; üç temel ilke '
                        .'birkaç hafta içinde gözle görülür fark yaratır.'),
            ],
            [
                'title' => 'Kuvvet Antrenmanında Doğru Teknik Neden Her Şeydir?',
                'category' => 'Antrenman', 'author' => 'Burak Şahin', 'reading_minutes' => 6,
                'cover' => '1526506118085-60ce8714f8c5', 'days_ago' => 28,
                'excerpt' => 'Ağırlık eklemeden önce öğrenilmesi gereken tek şey: form. '
                    .'Sakatlığı önler, gelişimi hızlandırır.',
                'body' => $p('Squat, deadlift ve bench press gibi bileşik hareketler en çok kas '
                        .'kütlesini çalıştırır; ancak hatalı form sakatlığa davetiyedir.')
                    .$p('Ego liftingi bırak, hareketi ağırlık eklemeden kusursuzlaştır. Eğitmen '
                        .'gözetiminde öğrenilen teknik, yıllar boyunca güvenle ilerlemeni sağlar.'),
            ],
            [
                'title' => 'Motivasyon Bittiğinde Disiplin Devralır',
                'category' => 'Yaşam', 'author' => 'Forge Ekibi', 'reading_minutes' => 4,
                'cover' => '1541534741688-6078c6bfb5c5', 'days_ago' => 35,
                'excerpt' => 'Herkesin motivasyonu düşer. Şampiyonları ayıran şey, o anlarda '
                    .'devreye giren alışkanlık sistemleridir.',
                'body' => $p('Motivasyon bir duygudur; gelir ve gider. Disiplin ise bir sistemdir. '
                        .'Antrenmanını takvime sabitle, kıyafetini akşamdan hazırla, küçük adımlar belirle.')
                    .$p('Bir günü kaçırırsan dünya bitmez; iki günü üst üste kaçırma. Tutarlılığın '
                        .'sırrı bu basit kuralda saklı.'),
            ],
        ];

        foreach ($posts as $i => $post) {
            Post::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'category' => $post['category'],
                    'author' => $post['author'],
                    'reading_minutes' => $post['reading_minutes'],
                    'cover_image' => DemoImage::unsplash($post['cover'], 1200, 750),
                    'is_published' => true,
                    'published_at' => now()->subDays($post['days_ago']),
                ]
            );
        }
    }
}
