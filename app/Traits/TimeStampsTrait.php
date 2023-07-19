<?php

namespace App\Traits;

use Carbon\Carbon;

trait TimeStampsTrait
{
    public function getCreatedAtAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->diffForHumans() : null;
    }

    public function getUpdatedAtAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->diffForHumans() : null;
    }
}
