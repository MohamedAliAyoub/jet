<?php

namespace App\Actions\Auth;

use App\Services\UserLogService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\ActionRequest;

class LoginAction
{
    use AsAction;

    private $userLogService;

    public function __construct(UserLogService $userLogService)
    {
        $this->userLogService = $userLogService;
    }


    final public function rules(ActionRequest $request): array
    {
        return [
            'email' => [
                'required',
                'email' => [
                    'required',
                    Rule::exists('users')->where(function ($query) use ($request) {
                        $query->where('name', $request->input('email'))
                            ->orWhere('email', $request->input('email'));
                    }),
                ],
            ],
            'password' => ['required'],
        ];
    }

    public function handle(ActionRequest $request)
    {
        $executed = RateLimiter::attempt(
            'login-' . $request->ip(),
            $perMinute = 5,
            function() use($request) {
                $credentials = $request->validated();
                // Check if the input is an email or username
                $field = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
                // Attempt authentication using the selected field
//               dd( Auth::attempt([$field => $credentials['email'], 'password' => $credentials['password']] ) ,
//
//                   $credentials['email']  , $credentials['password'] );
                if (Auth::attempt([$field => $credentials['email'], 'password' => $credentials['password']])) {
                    if (Auth::user()->is_active == false) {
                        toastr()->error(__('message.this_account_cant_active'));
                        Auth::logout();
                    }
                    $request->session()->regenerate();
//                    $this->userLogService->createLog('login_title' , 'login_message', auth()->user()->id);

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
