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

    public function handle(CreateAdminRequest $request, User $admin): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        if ($request->hours)
        {
            list($number1, $number2) = explode(":", $request->hours);

            $hours = (int)$number1;
            $minutes = (int)$number2;

            $data['hours'] = $hours * 60 + $minutes;
        }
        if ($request->hours_balance)
        {
            $hours_diff = ($admin->hours_balance - $request->hours_balance) * 60;
            $data['hours'] = $admin->hours - $hours_diff ;
        }
        unset($request->role_id);

        $admin->update($data);

        if ($request->role_id)
            $admin->roles()->sync([$request->role_id]);


        toastr()->success(__('message.success_response_message'));
        return back();

    }

    public function view_form(User $admin): \Inertia\Response
    {
        $admin->role_id = Role::query()->where('name', $admin->getRoles()->first())->first()?->id;
        return Inertia::render('Admin/EditAdmin', [
            'data' => $admin,
            'roles' => Role::query()->get(),
            'parents' => User::whereNull('parent_id')->get(),

        ]);
    }
}
