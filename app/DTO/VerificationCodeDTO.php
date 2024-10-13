<?php

namespace App\DTO;

use App\Abstract\DTO;
use Illuminate\Support\Carbon;

class VerificationCodeDTO extends DTO
{
    public string $identityNumber;
    public string $verificationFor;

    public string $code;

    public Carbon $createdAt;
    public Carbon $updatedAt;

    public static function create(array $data): VerificationCodeDTO
    {
        $code = rand(111111, 999999);

        return new self([
            'identityNumber'  => $data['identityNumber'],
            'verificationFor' => $data['verificationFor'],
            'code'            => $code,
            'createdAt'       => Carbon::now(),
            'updatedAt'       => Carbon::now(),
        ]);
    }

    public function toArray(): array
    {
        return [
            'identity_number'  => $this->identityNumber,
            'verification_for' => $this->verificationFor,
            'code'             => $this->code,
            'created_at'       => $this->createdAt,
            'updated_at'       => $this->updatedAt,
        ];
    }

}
