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

    public function handle(AdminChangePasswordRequest $request)
    {
        $admin = User::query()->find(auth()->user()->id);
        if (Hash::check($request->current_password, $admin->password)) {
            $admin->update(['password' => $request->new_password]);
            toastr()->success(__('message.success_response_message'));
        }else{
            throw ValidationException::withMessages(['message' => 'message.error_response_message']);
            toastr()->error(__('message.error_response_message'));
        }
        return back();


    }

    public function view_form()
    {
        return Inertia::render('Admin/EditProfileAdmin', ['data' => auth()->user()]);
    }
}
