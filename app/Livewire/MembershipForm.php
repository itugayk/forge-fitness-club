<?php

namespace App\Livewire;

use App\Models\MembershipApplication;
use App\Models\MembershipPlan;
use Livewire\Attributes\Computed;
use Livewire\Component;

class MembershipForm extends Component
{
    public ?int $selectedPlanId = null;

    public string $period = 'monthly';

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public ?string $birth_date = null;

    public ?string $goal = null;

    public string $message = '';

    public bool $submitted = false;

    public function mount(?string $plan = null, string $period = 'monthly'): void
    {
        $this->period = in_array($period, ['monthly', 'quarterly', 'yearly']) ? $period : 'monthly';

        if ($plan) {
            $this->selectedPlanId = MembershipPlan::where('slug', $plan)->value('id');
        }

        $this->selectedPlanId ??= MembershipPlan::active()->where('is_featured', true)->value('id')
            ?? MembershipPlan::active()->ordered()->value('id');
    }

    #[Computed]
    public function plans()
    {
        return MembershipPlan::active()->ordered()->get();
    }

    #[Computed]
    public function selectedPlan(): ?MembershipPlan
    {
        return $this->selectedPlanId ? MembershipPlan::find($this->selectedPlanId) : null;
    }

    public function selectPlan(int $id): void
    {
        $this->selectedPlanId = $id;
    }

    public function setPeriod(string $period): void
    {
        if (in_array($period, ['monthly', 'quarterly', 'yearly'])) {
            $this->period = $period;
        }
    }

    public function submit(): void
    {
        $validated = $this->validate(
            [
                'selectedPlanId' => 'required|exists:membership_plans,id',
                'period' => 'required|in:monthly,quarterly,yearly',
                'name' => 'required|string|min:3|max:80',
                'email' => 'required|email|max:120',
                'phone' => 'required|string|min:7|max:30',
                'birth_date' => 'nullable|date|before:today',
                'goal' => 'nullable|string|max:40',
                'message' => 'nullable|string|max:1000',
            ],
            [],
            [
                'selectedPlanId' => 'paket',
                'name' => 'ad soyad',
                'email' => 'e-posta',
                'phone' => 'telefon',
                'birth_date' => 'doğum tarihi',
            ]
        );

        MembershipApplication::create([
            'membership_plan_id' => $validated['selectedPlanId'],
            'billing_period' => $validated['period'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'birth_date' => $validated['birth_date'] ?: null,
            'goal' => $validated['goal'] ?: null,
            'message' => $validated['message'] ?: null,
            'status' => 'new',
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.membership-form');
    }
}
