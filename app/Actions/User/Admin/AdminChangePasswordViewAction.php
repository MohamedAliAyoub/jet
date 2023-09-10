<?php

namespace App\Actions\User\Admin;

use App\Http\Requests\Admin\AdminChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class AdminChangePasswordViewAction
{
    use AsAction;


    public function handle(): \Inertia\Response
    {
        return Inertia::render('Admin/ChangePasswordAdmin', ['data' => auth()->user()]);
    }
}
