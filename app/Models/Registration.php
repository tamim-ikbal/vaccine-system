<?php

namespace App\Models;

use App\Enums\VaccineType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vaccine_center_id',
        'vaccine_type',
        'vaccine_name'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vaccineCenter(): BelongsTo
    {
        return $this->belongsTo(VaccineCenter::class, 'vaccine_center_id', 'id');
    }

    public function vaccinations(): HasMany
    {
        return $this->hasMany(Vaccination::class);
    }

    protected function casts(): array
    {
        return [
            'vaccine_type' => VaccineType::class
        ];
    }

}
