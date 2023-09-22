<?php

namespace App\Enums;

enum ModuleName: string
{
    case HOME = 'home';
    case ADMINS = 'admins';
    case ROLES = 'roles';
    case TRIPS = 'trips';
    case NEXT_TRIPS = 'next_trips';
}
