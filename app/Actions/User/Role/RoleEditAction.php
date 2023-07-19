<?php

namespace App\Actions\User\Role;

use App\Enums\Abilities;
use Silber\Bouncer\Database\Role;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class RoleEditAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_ROLE_UPDATE;


    public function handle(Role $role)
    {
        $abilities = Abilities::getAllAbilitiesGroupByModule();
        $role->role_abilities = $role->abilities->pluck('name');
        return Inertia::render('Role/Form', [
            'model' => $role,
            'abilities' => $abilities
        ]);
    }
}
