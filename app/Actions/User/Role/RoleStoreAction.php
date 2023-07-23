<?php

namespace App\Actions\User\Role;

use App\Enums\Abilities;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Role\RoleRequest;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Silber\Bouncer\BouncerFacade as Bouncer;


class RoleStoreAction
{
    protected Abilities $ability = Abilities::MODULE_ROLE_CREATE;

    use AsAction;

    public function handle(RoleRequest $request)
    {
        $role =  Bouncer::role()->firstOrCreate($request->only('name') , $request->validated());
        Bouncer::sync($role)->abilities($request->validated('abilities'));

        toastr()->success(__('message.success_response_message'));
        return Redirect::route('user.role.index');
    }
}
