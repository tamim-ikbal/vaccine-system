<?php

namespace App\Livewire\Vaccine;

use App\DTO\RegistrationDTO;
use App\Livewire\Forms\Vaccine\RegistrationForm;
use App\Models\Disease;
use App\Models\User;
use App\Services\VaccineCenterService;
use App\Traits\Livewire\VerificationTrait;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Registration extends Component
{
    use VerificationTrait;

    public RegistrationForm $form;

    #[Computed]
    public function vaccineCenters(): Collection
    {
        return (new VaccineCenterService)->getVaccineCenters();
    }

    public function mount(): void
    {
        $disease = Disease::query()
            ->select(['id', 'name', 'display_name'])
            ->where('name', 'covid19')
            ->first();
        $this->form->setDisease($disease);
    }

    public function render()
    {
        return view('livewire.vaccine.registration');
    }

    public function submit()
    {
        $this->register();
    }

    protected function register(): void
    {
        $this->validate();

        if ($this->isAlreadyRegistered()) {
            $this->js("alert('Already Registered!');");
            return;
        }

        if (count($this->needToVerify) > 0) {
            $this->setVerifying(current($this->needToVerify));
            return;
        }

        $DTO = RegistrationDTO::create($this->preparedData());

        //Create User
        $user = User::query()->updateOrCreate([
            'identity_number' => $this->form->nid,
        ], $DTO->userData());

        //Enroll
        $registration = $user->registration()->create($DTO->registrationData());

        //Create Vaccinations
        $registration->vaccinations()->create($DTO->vaccination->toArray());

        session()->flash('toast', [
            'type'    => 'success',
            'message' => __('Registration successful'),
        ]);

        $this->redirect(route('home'));
    }

    protected function preparedData(): array
    {
        return array_merge($this->form->except('disease'), [
            'vaccine_id'        => $this->form->getVaccineId(),
            'disease_id'        => $this->form->disease->id ?? null,
            'dose_number'       => 1,
            'is_email_verified' => in_array('email', $this->verified),
            'is_phone_verified' => in_array('phone', $this->verified),
        ]);
    }

    protected function isAlreadyRegistered(): bool
    {
        return DB::table('registrations')
            ->join('users', function (JoinClause $join) {
                $join->on('users.id', '=', 'registrations.user_id')
                    ->where('users.identity_number', $this->form->nid);
            })
            ->where('disease_id', $this->form->disease->id)
            ->exists();
    }
}
