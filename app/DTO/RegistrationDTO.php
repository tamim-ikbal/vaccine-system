<?php

namespace App\DTO;

use App\Abstract\DTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationDTO extends DTO
{
    public VaccinationDTO $vaccination;
    public int $diseaseId;
    public string $name;
    public string $email;
    public string $phone;
    public string $password;
    public string $nid;
    public string $dob;
    public int $vaccine_center_id;
    public int $vaccine_id;

    public bool $isEmailVerified;
    public bool $isPhoneVerified;

    public static function create(array $data): RegistrationDTO
    {
        return new self([
            'diseaseId'         => $data['disease_id'],
            'name'              => $data['name'],
            'email'             => $data['email'],
            'phone'             => $data['phone'],
            'password'          => Hash::make($data['nid'].Str::random()),
            'nid'               => $data['nid'],
            'dob'               => $data['dob'],
            'vaccine_center_id' => $data['vaccine_center_id'],
            'vaccine_id'        => $data['vaccine_id'],
            'isEmailVerified'   => $data['is_email_verified'] ?? false,
            'isPhoneVerified'   => $data['is_phone_verified'] ?? false,
            'vaccination'       => new VaccinationDTO($data),
        ]);
    }

    public function userData(): array
    {
        $data = [
            'name'            => $this->name,
            'email'           => $this->email,
            'phone'           => $this->phone,
            'identity_number' => $this->nid,
            'dob'             => $this->dob,
            'password'        => $this->password,
        ];
        if ($this->isEmailVerified) {
            $data['email_verified_at'] = now();
        }
        if ($this->isPhoneVerified) {
            $data['phone_verified_at'] = now();
        }
        return $data;
    }

    public function registrationData(int $userId = null): array
    {
        $data = [
            'vaccine_center_id' => $this->vaccine_center_id,
            'vaccine_id'        => $this->vaccine_id,
            'disease_id'        => $this->diseaseId
        ];

        if ($userId) {
            $data['user_id'] = $userId;
        }

        return $data;
    }

    public function vaccinationData()
    {

    }
}
