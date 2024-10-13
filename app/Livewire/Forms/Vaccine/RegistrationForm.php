<?php

namespace App\Livewire\Forms\Vaccine;

use App\Models\Disease;
use App\Models\Vaccine;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Form;

class RegistrationForm extends Form
{
    #[Locked]
    public Disease $disease;

    public string $name;

    public string $email;
    public string $phone;
    public string $nid;
    public ?string $dob;

    public int $vaccine_center_id;

    protected string $dobFormat = 'Y-m-d';

    protected function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:100'],
            'email'             => ['required', 'string', 'email', 'max:190'],
            'phone'             => ['nullable', 'numeric', 'max_digits:11', 'regex:/^01[3-9][0-9]{8}$/'],
            'nid'               => [
                'required', 'string', 'regex:/^\w{10}$|^\w{14}$|^\w{17}$/',
            ],
            'dob'               => ['required', 'date', 'date_format:'.$this->dobFormat],
            'vaccine_center_id' => ['required', 'integer', 'exists:vaccine_centers,id'],
        ];
    }


    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number is invalid.',
            'nid.regex'   => 'The nid/birth certificate number is invalid.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'nid'               => 'nid/birth certificate number',
            'vaccine_center_id' => 'vaccine center',
        ];
    }

    protected function userData(): array
    {
        $data = [
            'name'            => $this->name,
            'email'           => $this->email,
            'phone'           => $this->phone,
            'identity_number' => $this->nid,
            'dob'             => Carbon::createFromFormat($this->dobFormat, $this->dob)->format('Y-m-d'),
            'password'        => Hash::make($this->nid.Str::random()),
        ];
        if ($this->emailVerified) {
            $data['email_verified_at'] = now();
        }
        if ($this->phoneVerified) {
            $data['phone_verified_at'] = now();
        }
        return $data;
    }

    protected function registrationData(): array
    {
        return [
            'vaccine_center_id' => $this->vaccine_center_id,
            'vaccine_id'        => $this->getVaccineId(),
            'disease_id'        => $this->disease->id,
        ];
    }

    //Static Vaccine Rules For Now
    public function getVaccineId()
    {
        return $this->setVaccineId();
    }

    public function setDisease(Disease $disease): void
    {
        $this->disease = $disease;
    }

    public function setMusVerifyEmail(bool $needVerification): void
    {
        $this->mustVerifyEmail = $needVerification;
    }

    protected function setVaccineId()
    {
        if (!$this->dob) {
            return null;
        }
        $vaccines = Vaccine::query()->where('disease_id', $this->disease->id)->get();
        //Vaccine Rule For Now
        $age = Carbon::createFromFormat($this->dobFormat, $this->dob)->diffInYears(Carbon::now());
//        return $age;
        $vaccineId = null;
        foreach ($vaccines as $vaccine) {
            if ($age >= 18 && $age < 30 && $vaccine->name === 'Pfizer') {
                $vaccineId = $vaccine->id;
                break;
            } elseif ($age >= 30 && $vaccine->name === 'Sinopharm') {
                $vaccineId = $vaccine->id;
                break;
            } else {
                $vaccineId = $vaccine->id;
            }
        }

        return $vaccineId;
    }

}
