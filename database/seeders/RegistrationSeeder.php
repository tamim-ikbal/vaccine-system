<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\Registration;
use App\Models\User;
use App\Models\Vaccination;
use App\Models\Vaccine;
use App\Models\VaccineCenter;
use App\Models\VaccineDose;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Registration::factory(20000)
            ->has(Vaccination::factory()->count(1))
            ->create();

//        $vaccine_centers = VaccineCenter::query()->take(495)->pluck('id')->toArray();
//        $vaccines = Vaccine::query()->pluck('id')->toArray();
//        $disease = Disease::query()->first();
//        return [
//            'user_id'           => User::factory()->create()->id,
//            'vaccine_center_id' => $this->faker->randomElement($vaccine_centers),
//            'vaccine_id'        => $this->faker->randomElement($vaccines),
//            'disease_id'        => $disease->id,
//        ];
    }
}
