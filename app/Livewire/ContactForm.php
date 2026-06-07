<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $subject = '';

    public string $message = '';

    public bool $submitted = false;

    public function submit(): void
    {
        $validated = $this->validate(
            [
                'name' => 'required|string|min:3|max:80',
                'email' => 'required|email|max:120',
                'phone' => 'nullable|string|max:30',
                'subject' => 'nullable|string|max:120',
                'message' => 'required|string|min:10|max:2000',
            ],
            [],
            [
                'name' => 'ad soyad',
                'email' => 'e-posta',
                'phone' => 'telefon',
                'subject' => 'konu',
                'message' => 'mesaj',
            ]
        );

        ContactMessage::create($validated + ['is_read' => false]);

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
