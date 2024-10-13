<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineDose extends Model
{
    /** @use HasFactory<\Database\Factories\VaccineDoseFactory> */
    use HasFactory;

    protected $fillable = [
        'vaccine_id',
        'name',
        'dose_number',
        'next_dose_interval'
    ];
}
