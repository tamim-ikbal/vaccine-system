<?php

namespace Database\Seeders;

use App\Enums\ScheduleType;
use App\Models\Disease;
use App\Models\Schedule;
use Carbon\CarbonInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disease = Disease::query()->first();

        Schedule::create([
            'disease_id' => $disease->id,
            'name'       => 'Covid-19 Vaccine Schedule',
            'type'       => ScheduleType::VACCINATION_SCHEDULE,
            'start_at'   => now()->toDateTimeString(),
            'end_at'     => null,
            'days'       => [
                CarbonInterface::SATURDAY,
                CarbonInterface::SUNDAY,
                CarbonInterface::MONDAY,
                CarbonInterface::TUESDAY,
                CarbonInterface::WEDNESDAY,
            ],
            'daily_at'   => '09:00',
        ]);
    }
}
