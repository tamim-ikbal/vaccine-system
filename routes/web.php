<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

Route::prefix('registrations')->name('registrations.')->group(function () {
    Route::get('/', [RegistrationController::class, 'create'])->name('create');
    Route::post('/', [RegistrationController::class, 'store'])->name('store');
});

Route::view('/vue', 'admin.app');

Route::get('test', function () {
    $startTime = microtime(true);
    $data = [
        'registrationId' => 'John Doe',
        'email'          => 'john@doe.com',
        'age'            => 32,
    ];

    dump($data);

    dump(date("H:i:s:v:u", microtime(true) - $startTime));


    $dto = new \App\DTO\VaccinationDTO(
        [
            'registration_id' => 5,
            'scheduled_at'    => now()->toDateString(),
            'vaccinated_at'   => now()->toDateString(),
            'dose_number'     => 2
        ]
    );

    dump(date("H:i:s:v:u", microtime(true) - $startTime));
    dd($dto->toArray());
});
