<?php

namespace App\Models;

use App\Enums\DiseaseType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VaccineCenter extends Model
{
    /** @use HasFactory<\Database\Factories\VaccineCenterFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'district',
    ];

    public function diseases(): BelongsToMany
    {
        return $this->belongsToMany(Disease::class, 'disease_vaccine_center', 'vaccine_center_id', 'disease_id')
            ->withPivot(['daily_limit']);
    }

}
