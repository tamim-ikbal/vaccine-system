<?php

namespace App\Enums;

enum VaccineName: string
{
    case PFIZER = 'Pfizer';
    case SINOPHARM = 'Sinopharm';
    case MODERNA = 'Moderna';
}
