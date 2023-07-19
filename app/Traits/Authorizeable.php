<?php

namespace App\Traits;

use App\Classes\Helpmate;
use App\Enums\Abilities;
use App\Exceptions\NotAuthorizedException;

trait Authorizeable
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        if(isset($this->ability)) {

            return Helpmate::checkAbility($this->ability);

        }

        return true;
    }

    /**
     * @return void
     * @throws NotAuthorizedException
     */
    public function checkAbility(Abilities $ability): void
    {
        if (! Helpmate::checkAbility($ability)) {

            throw new NotAuthorizedException;

        }
    }
    /**
     * @return void
     * @throws NotAuthorizedException
     */
    public function getAuthorizationFailure(): void
    {
        throw new NotAuthorizedException;
    }
}
