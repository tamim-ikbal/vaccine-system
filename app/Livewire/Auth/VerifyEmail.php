<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Locked;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class VerifyEmail extends Component
{
    #[Locked]
    public string $name;

    #[Locked]
    #[Reactive]
    public bool $codeSent;

    #[Locked]
    public string $verificationFor;

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
