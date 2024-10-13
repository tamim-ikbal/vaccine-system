<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vaccine extends Model
{
    /** @use HasFactory<\Database\Factories\VaccineFactory> */
    use HasFactory;

    protected $fillable = [
        'disease_id',
        'name',
        'description',
    ];

    public function doses(): HasMany
    {
        return $this->hasMany(VaccineDose::class, 'vaccine_id', 'id');
    }

    protected function casts()
    {
        return [
            'approved_date' => 'datetime'
        ];
    }
}
