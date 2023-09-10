<?php

namespace App\Enums;

enum TripStatusEnum: string
{
    use  \App\Traits\EnumOptionsTrait;

    case POSTING = 'posting';
    case WITH_PASSENGERS_ONBOARD = 'with_passengers_onboard';

}


