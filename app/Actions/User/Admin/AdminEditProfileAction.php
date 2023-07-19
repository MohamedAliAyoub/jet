<?php

namespace App\Actions\User\Admin;

use App\Http\Requests\Admin\CreateAdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class AdminEditProfileAction
{
    use AsAction;

    public function handle(CreateAdminRequest $request )
    {
        $admin = User::query()->find(auth()->user()->id);
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            if (Storage::exists('public/'.$admin->avatar))
                Storage::delete('public/'.($admin->avatar));
            $avatarPath = $request->file('avatar')->store('image/avatar', 'public');
            $data['avatar'] = $avatarPath;
        }
            $admin->update($data);
        toastr()->success(__('message.success_response_message'));
        return back();


    }

        public function view_form()
        {
            return Inertia::render('Admin/EditProfileAdmin', ['data' => auth()->user()]);
        }
    }
