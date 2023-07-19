<?php

namespace App\Actions;

// use App\Traits\JsonResponseTrait;
use App\Traits\Authorizeable;

class Action
{
    use Authorizeable;

    public function setFlashProp(array $data): void
    {
        session()->put('flashProp', $data);
    }
}
