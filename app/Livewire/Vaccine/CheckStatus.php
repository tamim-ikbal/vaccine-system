<?php

namespace App\Livewire\Vaccine;

use Illuminate\Database\Query\JoinClause;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Registration;

class CheckStatus extends Component
{
    #[Locked]
    public ?Registration $registration;

    #[Locked]
    public bool $notFound;

    // 'regex:/^\w{10}$|^\w{14}$|^\w{17}$/'],
    #[Rule(
        rule: ['required', 'string',],
        as: 'nid/birth certificate',
        message: ['regex' => 'Please provide a valid nid/birth certificate number.']
    )]
    public string $nid;
    #[Rule(rule: ['required', 'integer'], as: 'disease')]
    public int $disease_id;

    public function mount()
    {
        $this->notFound = false;
    }

    public function render()
    {
        return view('livewire.vaccine.check-status');
    }

    public function search(): void
    {
        $this->registration = null;

        $this->validate();

        $registration = Registration::query()
            ->select('registrations.*', 'users.name', 'diseases.display_name as disease_display_name')
            ->with([
                'vaccine' => fn($query) => $query->select('id', 'name'),
                'vaccinations'
            ])
            ->join('users', function (JoinClause $join) {
                $join->on('registrations.user_id', '=', 'users.id')
                    ->where('users.identity_number', $this->nid);
            })
            ->join('diseases', 'registrations.disease_id', '=', 'diseases.id')
            ->where('disease_id', $this->disease_id)
            ->first();

        if (!$registration) {
            $this->notFound = true;
            return;
        }

        $this->registration = $registration;
        $this->notFound = false;
        return;
    }
}
