<?php

namespace App\Actions\User\Role;

use App\Enums\Abilities;

use Lorisleiva\Actions\Concerns\AsAction;
use Silber\Bouncer\Database\Role;

class RoleDeleteAction
{
    use AsAction;
    protected Abilities $ability = Abilities::MODULE_ROLE_DELETE;


    public function handle(Role $role)
    {
        $role->delete();
        toastr()->success(__('message.success_response_message'));
        return back();
    }
}
