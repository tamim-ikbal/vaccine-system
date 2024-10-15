<?php

namespace App\Livewire\Vaccine;

use Livewire\Attributes\Locked;
use Livewire\Component;
use App\Models\Registration;

class ShowStats extends Component
{
    #[Locked]
    public Registration $registration;

    public function render()
    {
        return view('livewire.vaccine.show-stats');
    }
}
