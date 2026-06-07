<?php

namespace App\Livewire;

use App\Models\ClassBooking;
use App\Models\ClassCategory;
use App\Models\ClassSchedule;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Timetable extends Component
{
    public int $selectedDay = 1;

    public ?int $openScheduleId = null;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public bool $booked = false;

    public function mount(): void
    {
        $this->selectedDay = (int) now()->isoWeekday(); // 1=Pzt ... 7=Paz
    }

    #[Computed]
    public function schedules()
    {
        return ClassSchedule::active()
            ->with(['category', 'trainer'])
            ->withCount('confirmedBookings')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');
    }

    #[Computed]
    public function categories()
    {
        return ClassCategory::ordered()->get();
    }

    #[Computed]
    public function openSchedule(): ?ClassSchedule
    {
        if (! $this->openScheduleId) {
            return null;
        }

        return ClassSchedule::with(['category', 'trainer'])
            ->withCount('confirmedBookings')
            ->find($this->openScheduleId);
    }

    public function selectDay(int $day): void
    {
        $this->selectedDay = $day;
    }

    public function openClass(int $id): void
    {
        $this->openScheduleId = $id;
        $this->booked = false;
        $this->reset(['name', 'email', 'phone']);
        $this->resetErrorBag();
    }

    public function closeModal(): void
    {
        $this->reset(['openScheduleId', 'booked', 'name', 'email', 'phone']);
        $this->resetErrorBag();
    }

    public function book(): void
    {
        $schedule = $this->openSchedule;

        if (! $schedule) {
            return;
        }

        $this->validate(
            [
                'name' => 'required|string|min:3|max:60',
                'email' => 'required|email|max:120',
                'phone' => 'nullable|string|max:30',
            ],
            [],
            ['name' => 'ad soyad', 'email' => 'e-posta', 'phone' => 'telefon']
        );

        if ($schedule->confirmedBookings()->count() >= $schedule->capacity) {
            $this->addError('name', 'Üzgünüz, bu ders dolu. Lütfen başka bir seans seçin.');
            unset($this->openSchedule, $this->schedules);

            return;
        }

        $alreadyBooked = $schedule->bookings()
            ->where('email', $this->email)
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyBooked) {
            $this->addError('email', 'Bu e-posta ile bu derse zaten rezervasyon yapılmış.');

            return;
        }

        ClassBooking::create([
            'class_schedule_id' => $schedule->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: null,
            'status' => 'confirmed',
        ]);

        $this->booked = true;

        // Computed cache'lerini temizle ki kontenjan anında güncellensin.
        unset($this->openSchedule, $this->schedules);
    }

    public function render()
    {
        return view('livewire.timetable');
    }
}
