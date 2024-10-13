<?php

namespace App\Services;

use App\Enums\DiseaseType;
use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Collection;

class VaccineCenterService
{
    public function getVaccineCenters(?DiseaseType $vaccineType = null): Collection
    {
        if (!$vaccineType) {
            $vaccineType = DiseaseType::COVID19;
        }
        return VaccineCenter::query()
            ->select('id', 'name', 'district')
            ->get();
    }
}
