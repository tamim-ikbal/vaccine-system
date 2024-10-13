<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use Illuminate\Database\Seeder;

class VaccineDoseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaccines = Vaccine::all();
        $vaccines->each(function (Vaccine $vaccine) {
            $vaccine->doses()->createMany([
                ['name' => 'Dose 1', 'dose_number' => 1, 'next_dose_interval' => 90],
                ['name' => 'Dose 2', 'dose_number' => 2, 'next_dose_interval' => 122],
                ['name' => 'Booster Dose', 'dose_number' => 3],
            ]);
        });
    }
}
