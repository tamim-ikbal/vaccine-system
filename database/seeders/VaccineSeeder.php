<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\Vaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disease = Disease::query()->first();

        $disease->vaccines()->createMany([
            ['name' => 'Pfizer'],
            ['name' => 'Sinopharm'],
            ['name' => 'Moderna'],
        ]);

    }
}
