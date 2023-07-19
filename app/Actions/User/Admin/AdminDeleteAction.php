<?php

namespace App\Actions\User\Admin;

use App\Enums\Abilities;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class AdminDeleteAction
{
    use AsAction;
    protected Abilities $ability = Abilities::MODULE_ADMINS_DELETE;


    public function handle(User $admin)
    {
        if (Storage::exists('public/' . $admin->avatar))
            Storage::delete('public/' . ($admin->avatar));
        if ($admin->id != auth()->id()) {
            $admin->delete();
        }
        toastr()->success(__('message.success_response_message'));
        return back();
    }
}
