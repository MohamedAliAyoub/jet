<?php

namespace App\Classes;

use App\Enums\Abilities;

class Helpmate
{
    /**
     * @param Abilities $ability
     * @return bool
     */
    public static function checkAbility(Abilities $ability): bool
    {
        return auth()->user()?->can($ability->value);
    }

    /**
     * @param Abilities $ability
     * @return bool
     */
    public static function checkAbilities(Abilities $ability): bool
    {
        $userAbilities = session()->get('userAbilities');

        if(! is_array($userAbilities) || count($userAbilities) === 0) {
            return false;
        }

        return $userAbilities[0] === '*' || in_array($ability->value, $userAbilities);
    }
}
