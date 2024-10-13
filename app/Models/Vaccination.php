<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vaccination extends Model
{
    /** @use HasFactory<\Database\Factories\VaccinationFactory> */
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'scheduled_at',
        'vaccinated_at',
        'dose_number',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'vaccinated_at' => 'datetime',
        ];
    }
}
