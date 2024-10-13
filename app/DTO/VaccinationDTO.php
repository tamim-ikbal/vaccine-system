<?php

namespace App\DTO;

use App\Abstract\DTO;

class VaccinationDTO extends DTO
{
    public ?int $registrationId = null;
    public ?string $scheduledAt = null;
    public ?string $vaccinatedAt = null;

    public int $doseNumber;


    public function toArray(): array
    {
        $data = [
            'dose_number' => $this->doseNumber,
        ];

        if ($this->scheduledAt) {
            $data['scheduled_at'] = $this->scheduledAt;
        }
        if ($this->vaccinatedAt) {
            $data['vaccinated_at'] = $this->vaccinatedAt;
        }

        if ($this->registrationId) {
            $data['registration_id'] = $this->registrationId;
        }

        return $data;
    }

    protected function mapKeys(): array
    {
        return [
            'registrationId' => 'registration_id',
            'scheduledAt'    => 'scheduled_at',
            'vaccinatedAt'   => 'vaccinated_at',
            'doseNumber'     => 'dose_number',
        ];
    }

}
