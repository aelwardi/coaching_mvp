<?php

declare(strict_types=1);

namespace App\Enum;

enum statusSeanceEnum: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
}