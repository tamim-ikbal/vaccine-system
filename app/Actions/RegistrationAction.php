<?php

namespace App\Actions;

use App\Enums\VaccineName;
use App\Enums\DiseaseType;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationAction
{

    public function handle(array $userData, array $registrationData)
    {
        //Create User
        $user = User::create($userData);

        //Enroll
        $user->registration()->create($registrationData);

        //Send Notification

    }
}
