<?php

namespace App\Actions\Disease;

use App\DTO\DiseaseDTO;
use App\Models\Disease;

class StoreDiseaseAction
{
    public function handle(DiseaseDTO $dto)
    {
        return Disease::create($dto->toArray());
    }
}
