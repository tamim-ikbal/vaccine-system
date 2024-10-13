<?php

namespace Database\Seeders;

use App\Enums\DiseaseType;
use App\Models\Disease;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Disease::create([
            'name'         => 'covid19',
            'display_name' => 'COVID-19',
            'description'  => 'COVID-19 was born in China.',
        ]);
    }
}
