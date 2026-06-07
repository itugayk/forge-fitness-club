<?php

namespace Database\Seeders;

use App\Models\ClassCategory;
use App\Models\ClassSchedule;
use App\Models\Trainer;
use Illuminate\Database\Seeder;

class ClassScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $cat = ClassCategory::pluck('id', 'slug');
        $trn = Trainer::pluck('id', 'slug');

        // [gün, başlangıç, bitiş, başlık, kategori, eğitmen, kontenjan, seviye, salon]
        $rows = [
            // ── Pazartesi ──────────────────────────────────────────────
            [1, '07:00', '08:00', 'Sabah HIIT', 'hiit', 'deniz-korkmaz', 18, 'orta', 'Fonksiyonel Alan'],
            [1, '08:00', '09:00', 'Vinyasa Yoga', 'yoga', 'elif-demir', 20, 'tum-seviyeler', 'Stüdyo A'],
            [1, '12:30', '13:15', 'Express Fonksiyonel', 'fonksiyonel', 'mert-kaya', 16, 'orta', 'Fonksiyonel Alan'],
            [1, '18:00', '19:00', 'CrossFit WOD', 'crossfit', 'mert-kaya', 16, 'ileri', 'Fonksiyonel Alan'],
            [1, '18:00', '19:00', 'Reformer Pilates', 'pilates', 'selin-aydin', 12, 'orta', 'Stüdyo B'],
            [1, '19:00', '20:00', 'Spinning Ride', 'spinning', 'zeynep-arslan', 24, 'tum-seviyeler', 'Spin Salonu'],
            [1, '20:00', '21:00', 'Kickbox', 'kickbox', 'can-yildiz', 20, 'orta', 'Ring'],

            // ── Salı ───────────────────────────────────────────────────
            [2, '07:00', '08:00', 'Kuvvet Temelleri', 'kuvvet', 'burak-sahin', 12, 'baslangic', 'Kuvvet Bölgesi'],
            [2, '09:00', '10:00', 'Hatha Yoga', 'yoga', 'elif-demir', 20, 'baslangic', 'Stüdyo A'],
            [2, '12:30', '13:15', 'Express HIIT', 'hiit', 'deniz-korkmaz', 18, 'orta', 'Fonksiyonel Alan'],
            [2, '18:00', '19:00', 'Spinning Power', 'spinning', 'zeynep-arslan', 24, 'ileri', 'Spin Salonu'],
            [2, '19:00', '20:00', 'Mat Pilates', 'pilates', 'selin-aydin', 16, 'tum-seviyeler', 'Stüdyo B'],
            [2, '19:00', '20:00', 'Fonksiyonel Güç', 'fonksiyonel', 'mert-kaya', 16, 'orta', 'Fonksiyonel Alan'],
            [2, '20:00', '21:00', 'Boks Tekniği', 'kickbox', 'can-yildiz', 18, 'baslangic', 'Ring'],

            // ── Çarşamba ───────────────────────────────────────────────
            [3, '07:00', '08:00', 'Sabah Spinning', 'spinning', 'zeynep-arslan', 24, 'orta', 'Spin Salonu'],
            [3, '08:00', '09:00', 'Power Yoga', 'yoga', 'elif-demir', 20, 'orta', 'Stüdyo A'],
            [3, '12:30', '13:15', 'Lunch Crush HIIT', 'hiit', 'deniz-korkmaz', 18, 'ileri', 'Fonksiyonel Alan'],
            [3, '18:00', '19:00', 'CrossFit WOD', 'crossfit', 'mert-kaya', 16, 'ileri', 'Fonksiyonel Alan'],
            [3, '18:00', '19:00', 'Reformer Pilates', 'pilates', 'selin-aydin', 12, 'orta', 'Stüdyo B'],
            [3, '19:00', '20:00', 'Hipertrofi Kuvvet', 'kuvvet', 'burak-sahin', 12, 'orta', 'Kuvvet Bölgesi'],
            [3, '20:00', '21:00', 'Kickbox Combat', 'kickbox', 'can-yildiz', 20, 'ileri', 'Ring'],

            // ── Perşembe ───────────────────────────────────────────────
            [4, '07:00', '08:00', 'Sabah HIIT', 'hiit', 'deniz-korkmaz', 18, 'orta', 'Fonksiyonel Alan'],
            [4, '09:00', '10:00', 'Vinyasa Yoga', 'yoga', 'elif-demir', 20, 'tum-seviyeler', 'Stüdyo A'],
            [4, '12:30', '13:15', 'Express Fonksiyonel', 'fonksiyonel', 'mert-kaya', 16, 'orta', 'Fonksiyonel Alan'],
            [4, '18:00', '19:00', 'Spinning Ride', 'spinning', 'zeynep-arslan', 24, 'tum-seviyeler', 'Spin Salonu'],
            [4, '19:00', '20:00', 'Mat Pilates', 'pilates', 'selin-aydin', 16, 'baslangic', 'Stüdyo B'],
            [4, '19:00', '20:00', 'Olimpik Halter', 'kuvvet', 'burak-sahin', 10, 'ileri', 'Kuvvet Bölgesi'],
            [4, '20:00', '21:00', 'Boks Sparring', 'kickbox', 'can-yildiz', 16, 'ileri', 'Ring'],

            // ── Cuma ───────────────────────────────────────────────────
            [5, '07:00', '08:00', 'Sabah Yoga', 'yoga', 'elif-demir', 20, 'baslangic', 'Stüdyo A'],
            [5, '08:00', '09:00', 'Kuvvet Temelleri', 'kuvvet', 'burak-sahin', 12, 'baslangic', 'Kuvvet Bölgesi'],
            [5, '12:30', '13:15', 'Friday Burn HIIT', 'hiit', 'deniz-korkmaz', 18, 'orta', 'Fonksiyonel Alan'],
            [5, '18:00', '19:00', 'CrossFit Team WOD', 'crossfit', 'mert-kaya', 20, 'tum-seviyeler', 'Fonksiyonel Alan'],
            [5, '19:00', '20:00', 'Spinning Party', 'spinning', 'zeynep-arslan', 24, 'tum-seviyeler', 'Spin Salonu'],
            [5, '20:00', '21:00', 'Kickbox', 'kickbox', 'can-yildiz', 20, 'orta', 'Ring'],

            // ── Cumartesi ──────────────────────────────────────────────
            [6, '09:00', '10:00', 'Hafta Sonu CrossFit', 'crossfit', 'mert-kaya', 20, 'tum-seviyeler', 'Fonksiyonel Alan'],
            [6, '10:00', '11:00', 'Vinyasa Flow Yoga', 'yoga', 'elif-demir', 22, 'tum-seviyeler', 'Stüdyo A'],
            [6, '11:00', '12:00', 'Reformer Pilates', 'pilates', 'selin-aydin', 12, 'orta', 'Stüdyo B'],
            [6, '12:00', '13:00', 'Spinning Endurance', 'spinning', 'zeynep-arslan', 24, 'ileri', 'Spin Salonu'],
            [6, '13:00', '14:00', 'Aile HIIT', 'hiit', 'deniz-korkmaz', 20, 'baslangic', 'Fonksiyonel Alan'],

            // ── Pazar ──────────────────────────────────────────────────
            [7, '10:00', '11:00', 'Restoratif Yoga', 'yoga', 'elif-demir', 22, 'baslangic', 'Stüdyo A'],
            [7, '11:00', '12:00', 'Mobilite & Pilates', 'pilates', 'selin-aydin', 16, 'tum-seviyeler', 'Stüdyo B'],
            [7, '12:00', '13:00', 'Fonksiyonel Açık Alan', 'fonksiyonel', 'mert-kaya', 18, 'tum-seviyeler', 'Fonksiyonel Alan'],
        ];

        foreach ($rows as $i => $r) {
            [$day, $start, $end, $title, $catSlug, $trnSlug, $cap, $level, $room] = $r;

            ClassSchedule::updateOrCreate(
                [
                    'day_of_week' => $day,
                    'start_time' => $start,
                    'title' => $title,
                ],
                [
                    'class_category_id' => $cat[$catSlug] ?? null,
                    'trainer_id' => $trn[$trnSlug] ?? null,
                    'end_time' => $end,
                    'capacity' => $cap,
                    'level' => $level,
                    'room' => $room,
                    'is_active' => true,
                    'sort_order' => $i,
                    'description' => null,
                ]
            );
        }
    }
}
