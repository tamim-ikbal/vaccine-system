<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\VaccineCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disease = Disease::query()->first();

        VaccineCenter::factory(495)
            ->create()
            ->each(function ($vaccineCenter) use ($disease) {
                $vaccineCenter->diseases()->attach($disease->id, ['daily_limit' => 1]);
            });

        VaccineCenter::factory(1000)->create();
    }
}
