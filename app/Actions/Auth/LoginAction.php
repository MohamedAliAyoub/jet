<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\ActionRequest;

class LoginAction
{
    use AsAction;

    final public function rules(ActionRequest $request): array
    {
       return [
           'email' => ['required', 'email'],
           'password' => ['required'],
       ];
    }

    public function handle(ActionRequest $request)
    {
        $executed = RateLimiter::attempt(
            'login-' . $request->ip(),
            $perMinute = 5,
            function() use($request) {
                if (Auth::attempt($request->validated()) ) {
                    if (Auth::user()->is_active == false) {
                        toastr()->error(__('message.this_account_cant_active'));
                        Auth::logout();
                    }
                    $request->session()->regenerate();
                    return redirect()->intended(route('user.home'));
                }

                throw ValidationException::withMessages([
                    'message' => __('message.login_not_valid'),
                ]);

                return redirect()->back();
            }
        );
        if(!$executed)
            return redirect()->back()->with('error', 'limiter');
        return $executed;
    }
}
