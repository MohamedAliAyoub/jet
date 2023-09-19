<?php

namespace App\Actions\Api\Auth;

use App\Classes\Response;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\User\AuthUserResource;
use App\Services\UserLogService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;


class ClientLoginAction
{
    use AsAction;

    private $userLogService;

    public function __construct(UserLogService $userLogService)
    {
        $this->userLogService = $userLogService;
    }

    public function handle(LoginRequest $request): \Illuminate\Http\JsonResponse
    {

        $credentials = $request->validated();

        $guard = Auth::guard('web');

        // Attempt authentication with email
        if ($guard->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = $guard->user();
        }
        // If authentication with email fails, attempt with name
        elseif ($guard->attempt(['name' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = $guard->user();
        }
        // If both attempts fail, throw an authentication error
        else {
            throw ValidationException::withMessages([
                'message' => __('auth.failed'),
            ]);
        }

        if (! $user->is_active) {
            throw ValidationException::withMessages([
                'message' => __('auth.deactivated'),
            ]);
        }

        $token = $user->createToken('client-token')->plainTextToken;

        $client = AuthUserResource::make($user);

        $this->userLogService->createLog( __('message.login_title'), __('message.login_message', ['created_at' => Carbon::now()]), auth()->user()->id);
        return Response::success(compact('token', 'client'));
    }


}
