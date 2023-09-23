<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case ADMIN = 'admin';
    case RELATIVE= 'relative';
    case TRAVELLER = 'traveller';
}
