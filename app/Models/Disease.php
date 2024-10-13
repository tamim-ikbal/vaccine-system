<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disease extends Model
{
    /** @use HasFactory<\Database\Factories\DiseaseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'display_name'
    ];

    public function vaccines(): HasMany
    {
        return $this->hasMany(Vaccine::class);
    }

    public function vaccineCenters(): BelongsToMany
    {
        return $this->belongsToMany(VaccineCenter::class, 'disease_vaccine_center', 'disease_id', 'vaccine_center_id')
            ->withPivot(['daily_limit']);
    }

}
