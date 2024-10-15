<?php

namespace App\Enums;

enum ScheduleType: string
{
    case ARTISAN_COMMAND = 'artisan-command';
    case JOB = 'job';

    case SHELL_COMMAND = 'shell-command';
}
