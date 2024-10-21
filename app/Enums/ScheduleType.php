<?php

namespace App\Enums;

enum ScheduleType: string
{
    case VACCINATION_SCHEDULE = 'vaccination-schedule';
    case CLEANUP = 'cleanup';
}
