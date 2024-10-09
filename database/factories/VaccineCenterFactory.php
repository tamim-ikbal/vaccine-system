<?php

namespace Database\Factories;

use App\Enums\VaccineType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VaccineCenter>
 */
class VaccineCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->streetName(),
            'daily_limit' => $this->faker->randomNumber(2),
            'district' => $this->faker->city(),
            'vaccine_type' => VaccineType::COVID19
        ];
    }
}
