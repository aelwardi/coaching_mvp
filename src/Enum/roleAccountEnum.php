<?php

declare(strict_types=1);

namespace App\Enum;

enum roleAccountEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case BANNED = 'banned';
}