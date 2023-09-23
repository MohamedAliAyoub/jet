<?php

namespace App\Actions\User\Admin;

use App\Enums\Abilities;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class AdminChangeIsActiveAction
{
    use AsAction;
    protected Abilities $ability = Abilities::MODULE_ADMINS_ACTIVE;

    public function handle(User $admin): \Illuminate\Http\RedirectResponse
    {
        $admin->is_active = ! $admin->is_active;

        $admin->save();
        toastr()->success(__('message.success_response_message'));
        return back();
    }
}
