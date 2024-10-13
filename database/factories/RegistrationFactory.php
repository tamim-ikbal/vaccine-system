<?php

namespace Database\Factories;

use App\Enums\VaccineName;
use App\Enums\DiseaseType;
use App\Models\Disease;
use App\Models\User;
use App\Models\Vaccine;
use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vaccine_centers = VaccineCenter::query()->take(495)->pluck('id')->toArray();
        $vaccines = Vaccine::query()->pluck('id')->toArray();
        $disease = Disease::query()->first();
        return [
            'user_id'           => User::factory()->create()->id,
            'vaccine_center_id' => $this->faker->randomElement($vaccine_centers),
            'vaccine_id'        => $this->faker->randomElement($vaccines),
            'disease_id'        => $disease->id,
        ];
    }
}
