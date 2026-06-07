<?php

namespace Database\Seeders;

use App\Models\ClassCategory;
use Illuminate\Database\Seeder;

class ClassCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'CrossFit', 'slug' => 'crossfit', 'color' => '#c5ff3d', 'description' => 'Yüksek yoğunluklu fonksiyonel antrenman.'],
            ['name' => 'HIIT', 'slug' => 'hiit', 'color' => '#ff5e1a', 'description' => 'Kısa, yoğun interval yağ yakım seansları.'],
            ['name' => 'Yoga', 'slug' => 'yoga', 'color' => '#7dd3fc', 'description' => 'Nefes, esneklik ve denge odaklı akış.'],
            ['name' => 'Pilates', 'slug' => 'pilates', 'color' => '#c084fc', 'description' => 'Core gücü ve postür için reformer & mat.'],
            ['name' => 'Spinning', 'slug' => 'spinning', 'color' => '#fbbf24', 'description' => 'Müzik eşliğinde yüksek tempolu bisiklet.'],
            ['name' => 'Fonksiyonel', 'slug' => 'fonksiyonel', 'color' => '#34d399', 'description' => 'Günlük hareket kalıplarını güçlendiren antrenman.'],
            ['name' => 'Kickbox', 'slug' => 'kickbox', 'color' => '#f87171', 'description' => 'Boks & tekme kombinasyonlarıyla kardiyo.'],
            ['name' => 'Kuvvet', 'slug' => 'kuvvet', 'color' => '#a3e635', 'description' => 'Bileşik hareketlerle maksimal kuvvet gelişimi.'],
        ];

        foreach ($categories as $i => $c) {
            ClassCategory::updateOrCreate(['slug' => $c['slug']], $c + ['sort_order' => $i]);
        }
    }
}
