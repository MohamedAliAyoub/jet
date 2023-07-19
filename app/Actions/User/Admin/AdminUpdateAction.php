<?php

namespace App\Actions\User\Admin;

use App\Enums\Abilities;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Silber\Bouncer\Bouncer;

class AdminUpdateAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_ADMINS_UPDATE;

    public function handle(CreateAdminRequest $request, User $admin)
    {
        $data = $request->validated();
        unset($request->role_id);
        if ($request->hasFile('avatar')) {
            if (Storage::exists('public/' . $admin->avatar))
                Storage::delete('public/' . ($admin->avatar));
            $avatarPath = $request->file('avatar')->store('image/avatar', 'public');
            $data['avatar'] = $avatarPath;
        }
        $admin->update($data);


        if ($request->role_id)
            $admin->roles()->sync([$request->role_id]);


        toastr()->success(__('message.success_response_message'));
        return back();

    }

    public function view_form(User $admin)
    {
        $admin->role_id = Role::query()->where('name', $admin->getRoles()->first())->first()?->id;
        return Inertia::render('Admin/EditAdmin', [
            'data' => $admin,
            'roles' => Role::query()->get()
        ]);
    }
}
