<?php

namespace Database\Seeders;

use App\Models\ClassBooking;
use App\Models\ClassSchedule;
use App\Models\ContactMessage;
use App\Models\MembershipApplication;
use App\Models\MembershipPlan;
use Illuminate\Database\Seeder;

class DemoSubmissionsSeeder extends Seeder
{
    private array $first = ['Ahmet', 'Mehmet', 'Ayşe', 'Fatma', 'Ali', 'Zeynep', 'Mustafa', 'Elif',
        'Hüseyin', 'Emine', 'Burak', 'Seda', 'Onur', 'Gizem', 'Cem', 'Pınar', 'Tolga', 'Ece',
        'Kaan', 'İrem', 'Berk', 'Selin', 'Murat', 'Deniz', 'Eda', 'Volkan', 'Naz', 'Sinan'];

    private array $last = ['Yılmaz', 'Demir', 'Şahin', 'Çelik', 'Yıldız', 'Aydın', 'Öztürk', 'Arslan',
        'Doğan', 'Kılıç', 'Aslan', 'Çetin', 'Kara', 'Koç', 'Kurt', 'Özkan', 'Şimşek', 'Polat'];

    private function person(): array
    {
        $name = $this->first[array_rand($this->first)].' '.$this->last[array_rand($this->last)];
        $slug = str_replace(' ', '.', mb_strtolower(str_replace(
            ['ı', 'ş', 'ğ', 'ü', 'ö', 'ç', 'İ'],
            ['i', 's', 'g', 'u', 'o', 'c', 'i'],
            $name
        )));

        return [
            'name' => $name,
            'email' => $slug.'@example.com',
            'phone' => '05'.rand(30, 59).' '.rand(100, 999).' '.rand(10, 99).' '.rand(10, 99),
        ];
    }

    public function run(): void
    {
        $this->seedBookings();
        $this->seedApplications();
        $this->seedContacts();
    }

    /** Her derse gerçekçi doluluk oranıyla rezervasyon ekler. */
    private function seedBookings(): void
    {
        if (ClassBooking::exists()) {
            return; // tekrar tohumlamada şişmeyi önle
        }

        $schedules = ClassSchedule::all();

        foreach ($schedules as $index => $schedule) {
            // %35 – %95 arası doluluk; birkaç ders tamamen dolu olsun.
            $fraction = in_array($index % 9, [2, 6]) ? 1.0 : rand(35, 90) / 100;
            $count = (int) round($schedule->capacity * $fraction);

            for ($i = 0; $i < $count; $i++) {
                $person = $this->person();
                ClassBooking::create([
                    'class_schedule_id' => $schedule->id,
                    'name' => $person['name'],
                    'email' => $person['email'],
                    'phone' => $person['phone'],
                    'status' => 'confirmed',
                    'created_at' => now()->subDays(rand(0, 6))->subHours(rand(0, 23)),
                ]);
            }
        }
    }

    private function seedApplications(): void
    {
        if (MembershipApplication::exists()) {
            return;
        }

        $plans = MembershipPlan::pluck('id', 'slug');
        $goals = array_keys(MembershipApplication::goals());
        $periods = ['monthly', 'quarterly', 'yearly'];

        $rows = [
            ['performans', 'new', 'Akşam grup derslerine katılmak istiyorum, bilgi alabilir miyim?'],
            ['baslangic', 'contacted', 'Spora yeni başlıyorum, başlangıç değerlendirmesi için randevu istiyorum.'],
            ['elite', 'approved', 'PT ve beslenme paketiyle ilgileniyorum.'],
            ['ogrenci', 'new', 'Öğrenci indirimi geçerli mi?'],
            ['performans', 'new', null],
            ['elite', 'rejected', 'Yıllık ödeme yapmak istiyorum.'],
            ['baslangic', 'contacted', 'Sabah saatlerinde müsait dersler hangileri?'],
        ];

        foreach ($rows as $i => [$planSlug, $status, $message]) {
            $person = $this->person();
            MembershipApplication::create([
                'membership_plan_id' => $plans[$planSlug] ?? null,
                'name' => $person['name'],
                'email' => $person['email'],
                'phone' => $person['phone'],
                'birth_date' => now()->subYears(rand(19, 44))->subDays(rand(0, 360)),
                'goal' => $goals[array_rand($goals)],
                'billing_period' => $periods[array_rand($periods)],
                'message' => $message,
                'status' => $status,
                'created_at' => now()->subDays($i)->subHours(rand(0, 23)),
            ]);
        }
    }

    private function seedContacts(): void
    {
        if (ContactMessage::exists()) {
            return;
        }

        $rows = [
            ['Sponsorluk teklifi', 'Markamız için iş birliği görüşmek isteriz.', false],
            ['Üyelik dondurma', 'Yurt dışına çıkacağım, üyeliğimi 2 ay dondurabilir miyim?', false],
            ['Otopark', 'Tesiste üyelere özel otopark mevcut mu?', true],
            ['Kayıp eşya', 'Dün soyunma odasında saatimi unuttum.', true],
        ];

        foreach ($rows as $i => [$subject, $message, $read]) {
            $person = $this->person();
            ContactMessage::create([
                'name' => $person['name'],
                'email' => $person['email'],
                'phone' => $person['phone'],
                'subject' => $subject,
                'message' => $message,
                'is_read' => $read,
                'created_at' => now()->subDays($i)->subHours(rand(0, 23)),
            ]);
        }
    }
}
