<?php

namespace App\Services;

use App\Enums\DiseaseType;
use App\Models\VaccineCenter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VaccineCenterService
{
    public function getVaccineCenters(?DiseaseType $vaccineType = null): Collection
    {
        if (!$vaccineType) {
            $vaccineType = DiseaseType::COVID19;
        }
        return DB::table('vaccine_centers')
            ->select('id', 'name', 'district')
            ->get();
    }
}
