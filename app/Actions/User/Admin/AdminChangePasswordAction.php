<?php

namespace App\Actions\User\Admin;

use App\Http\Requests\Admin\AdminChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class AdminChangePasswordAction
{
    use AsAction;

    public function handle(AdminChangePasswordRequest $request): \Illuminate\Http\RedirectResponse
    {
        $admin = User::query()->find(auth()->id());
        if (!Hash::check($request->current_password, $admin->password)) {
            throw ValidationException::withMessages(['message' => __('message.error_response_message')]);
        }
        $admin->update(['password' => $request->password]);

        toastr()->success(__('message.success_response_message'));
        return back();


    }

    public function view_form(): \Inertia\Response
    {
        return Inertia::render('Admin/EditProfileAdmin', ['data' => auth()->user()]);
    }
}
