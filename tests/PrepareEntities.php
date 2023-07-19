<?php

namespace Tests;

use App\Enums\Abilities;
use App\Models\User;

trait PrepareEntities
{
    protected $fakeUser;

    /**
     * create fake admin for test.
     *
     * @param  \App\Enums\Abilities|null $ability
     * @return \App\Models\User
     */
    public function fakeUser(Abilities $ability = NULL)
    {
        if(! $this->fakeUser) {

            $this->fakeUser = User::factory()->create();

            if($ability) {
                $this->fakeUser->allow($ability->value);
            }

        }

        return $this->fakeUser;
    }
}
