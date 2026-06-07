<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Support\DemoImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['Kuvvet Bölgesi', '1534438327276-14e5300c3a48', 'Tesis'],
            ['Grup Dersi Enerjisi', '1571019613454-1cb2f99b2d8b', 'Dersler'],
            ['Fonksiyonel Alan', '1581009146145-b5ef050c2e1e', 'Tesis'],
            ['CrossFit WOD', '1534367610401-9f5ed68180aa', 'Dersler'],
            ['Dönüşüm Hikayesi', '1599058917212-d750089bc07e', 'Dönüşüm'],
            ['Spinning Salonu', '1518611012118-696072aa579a', 'Tesis'],
            ['Kettlebell Akışı', '1583454110551-21f2fa2afe61', 'Dersler'],
            ['Açık Hava Etkinliği', '1571902943202-507ec2618e8f', 'Etkinlik'],
            ['Sabah Antrenmanı', '1574680096145-d05b474e2155', 'Dersler'],
            ['Yarışma Günü', '1605296867304-46d5465a13f1', 'Etkinlik'],
            ['Kardiyo Bölgesi', '1538805060514-97d9cc17730c', 'Tesis'],
            ['Hedefe Kilitlen', '1532384748853-8f54a8f476e2', 'Dönüşüm'],
        ];

        foreach ($items as $i => [$title, $id, $category]) {
            GalleryImage::updateOrCreate(
                ['title' => $title],
                [
                    'image' => DemoImage::unsplash($id, 800, 800),
                    'category' => $category,
                    'is_active' => true,
                    'sort_order' => $i,
                ]
            );
        }
    }
}
