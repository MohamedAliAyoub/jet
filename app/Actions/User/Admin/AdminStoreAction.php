<?php

namespace App\Actions\User\Admin;

use App\Enums\Abilities;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class AdminStoreAction
{
    protected Abilities $ability = Abilities::MODULE_ADMINS_CREATE;

    use AsAction;

    public function handle(CreateAdminRequest $request)
    {
        $user = User::query()->create(array_merge($request->validated(), [
            'avatar' => $request->file('avatar')?->store('image/avatar', 'public'),
        ]));
        if ($request->role_id)
            $user->assign($request->role_id);
        toastr()->success(__('message.success_response_message'));
        return Redirect::route('user.admins.index');
    }

    public function view_form()
    {
        return Inertia::render('Admin/CreateAdmin', ['roles' => Role::query()->get()]);
    }
}
