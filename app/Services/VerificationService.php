<?php

namespace App\Services;

use App\DTO\VerificationCodeDTO;
use App\Enums\VerificationMethod;
use App\Mail\SendVerificationCode;
use App\Models\VerificationCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class VerificationService
{
    public static function sendCode(VerificationCodeDTO $DTO, VerificationMethod $method): bool
    {
        $status = VerificationCode::query()->updateOrInsert(
            [
                'identity_number'  => $DTO->identityNumber,
                'verification_for' => $DTO->verificationFor,
            ], $DTO->toArray()
        );

        if ($status) {
            //Send Notification
            switch ($method->value) {
                case 'sms':
                    //
                    break;
                case 'mail':
                    Mail::to($DTO->verificationFor)->send(new SendVerificationCode($DTO));
                    break;
            }
        }

        return (bool) $status;
    }

    public static function verifyCode(string $identity, string $verificationFor, string $code): bool
    {
        $OTPLife = Carbon::now()->addMinutes(5);
        $exists = VerificationCode::query()
            ->where('identity_number', $identity)
            ->where('verification_for', $verificationFor)
            ->where('code', $code)
            ->first();

        if (!$exists || Carbon::now()->greaterThan($OTPLife)) {
            return false;
        }

        //CleanUp
        $exists->delete();

        return true;
    }
}
