<?php

namespace Database\Factories;

use App\Enums\VaccineType;
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
        $vaccine_centers = VaccineCenter::query()->pluck('id')->toArray();
        $vaccine_names = ['Pfizer', 'Sinopharm', 'Moderna'];
        return [
            'vaccine_center_id' => $this->faker->randomElement($vaccine_centers),
            'vaccine_type' => VaccineType::COVID19,
            'vaccine_name' => $this->faker->randomElement($vaccine_names),
        ];
    }
}
