<?php

use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Schedule;

//
Schedule::command('vaccine:date-notification covid19')
    ->days([
        CarbonInterface::SATURDAY,
        CarbonInterface::SUNDAY,
        CarbonInterface::MONDAY,
        CarbonInterface::TUESDAY,
        CarbonInterface::WEDNESDAY,
    ])
    ->at('9:00');
