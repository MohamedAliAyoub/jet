<?php


namespace App\Actions\Api\Auth;


use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ClientLogoutAction
{
    use AsAction;

    public function handle(ActionRequest $request): \Illuminate\Http\JsonResponse
    {
        auth('sanctum')->user()->tokens()->delete();
        return response()->json([
            'message' =>  __('message.success_response_message'),
        ]);
    }




}
