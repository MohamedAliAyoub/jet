<?php

namespace App\Actions\User\Role;

use App\Enums\Abilities;
use App\Enums\AbilitiesEnum;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Role\RoleRequest;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

class RoleCreateAction
{
    protected Abilities $ability = Abilities::MODULE_ROLE_CREATE;

    use AsAction;


    public function handle()
    {

        $abilities = Abilities::getAllAbilitiesGroupByModule();
        return Inertia::render('Role/Form' , ['abilities' => $abilities]);
    }
}
