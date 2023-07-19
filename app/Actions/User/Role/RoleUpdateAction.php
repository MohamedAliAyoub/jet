<?php

namespace App\Actions\User\Role;
use Bouncer;

use App\Enums\Abilities;
use App\Http\Requests\Role\RoleRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Silber\Bouncer\Database\Role;


class RoleUpdateAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_ROLE_UPDATE;

    public function handle(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());
       Bouncer::sync($role)->abilities($request->validated('abilities'));

        toastr()->success(__('message.success_response_message'));
        return back();


    }

}
