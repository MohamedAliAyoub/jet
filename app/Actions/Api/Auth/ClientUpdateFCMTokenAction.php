<?php

namespace App\Actions\Api\Auth;

use App\Classes\Response;
use App\Http\Requests\Api\Auth\ClientUpdateFCMTokenRequest;
use Lorisleiva\Actions\Concerns\AsAction;


class ClientUpdateFCMTokenAction
{
    use AsAction;


    public function handle(ClientUpdateFCMTokenRequest $request): \Illuminate\Http\JsonResponse
    {
        $client = $request->user();

        $client->update([
            'fcm_token' => $request->validated('fcm_token'),
        ]);

        return Response::success([
            'fcm_token' => $client->fcm_token,
        ]);
    }

}
