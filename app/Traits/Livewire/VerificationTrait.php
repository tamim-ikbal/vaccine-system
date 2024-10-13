<?php

namespace App\Traits\Livewire;

use App\DTO\VerificationCodeDTO;
use App\Enums\VerificationMethod;
use App\Services\VerificationService;
use Livewire\Attributes\Locked;

trait VerificationTrait
{
    public string $verification_code;
    #[Locked]
    public array $needToVerify = [
        'email'
    ];

    #[Locked]
    public array $verified = [];

    #[Locked]
    public string $isVerifying = '';
    #[Locked]
    public bool $sentVerificationCode = false;

    protected function setVerifying(string $name): void
    {
        if (!in_array($name, $this->verified)) {
            $this->isVerifying = $name;
        }
    }

    public function getIsVerifying(): ?string
    {
        return $this->isVerifying;
    }

    public function sendCode(string $name): void
    {
        sleep(3);

        $this->validate();

        if (!$this->shouldVerify($name) || $this->isVerifying !== $name) {
            //
            $this->js("alert('Not Verifying!')");
            return;
        }

        //Send Code
        $DTO = VerificationCodeDTO::create([
            'identityNumber'  => $this->form->nid,
            'verificationFor' => $this->form->email
        ]);

        VerificationService::sendCode($DTO, VerificationMethod::MAIL);

        $this->sentVerificationCode = true;
    }

    public function verify(string $name): void
    {
        sleep(5);

        $this->validate([
            'verification_code' => 'required|string',
        ]);

        if (!$this->shouldVerify($name)) {
            //
            return;
        }

        //Verification Done
        $isVerified = VerificationService::verifyCode($this->form->nid, $this->form->email,
            $this->verification_code);

        if (!$isVerified) {
            $this->addError('verification_code', 'Wrong verification code!');
            return;
        }

        //CLeanUp
        $this->cleanUpForNextVerify($name);

        $this->register();

    }

    protected function shouldVerify(string $name): bool
    {
        return in_array($name, $this->needToVerify) && !in_array($name, $this->verified);
    }

    protected function isVerified(string $name): bool
    {
        return in_array($name, $this->needToVerify);
    }

    protected function cleanUpForNextVerify(string $name): void
    {
        $this->verified[] = $name;
        unset($this->needToVerify[array_search($name, $this->needToVerify)]);

        $this->sentVerificationCode = false;
    }

}
