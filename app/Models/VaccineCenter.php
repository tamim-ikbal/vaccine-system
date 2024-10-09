<?php

namespace App\Models;

use App\Enums\VaccineType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    /** @use HasFactory<\Database\Factories\VaccineCenterFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'daily_limit',
        'district',
        'vaccine_type'
    ];

    protected function casts(): array
    {
        return [
            'vaccine_type' => VaccineType::class
        ];
    }
}
