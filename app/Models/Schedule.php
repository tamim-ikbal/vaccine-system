<?php

namespace App\Models;

use App\Enums\ScheduleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'disease_id',
        'name',
        'type',
        'start_at',
        'end_at',
        'days',
        'daily_at'
    ];

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    protected function casts()
    {
        return [
            'start_at' => 'datetime',
            'end_at'   => 'datetime',
            'days'     => 'array',
            'type'     => ScheduleType::class
        ];
    }
}
