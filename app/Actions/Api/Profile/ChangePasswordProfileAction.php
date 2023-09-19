<?php

namespace App\Actions\Api\Profile;

use App\Classes\Response;
use App\Http\Requests\Api\Profile\ChageProfilePasswordRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class ChangePasswordProfileAction
{
    use AsAction;

    public function handle(ChageProfilePasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $client = Client::query()
            ->find(auth('client-api')->user()->id);

        if (!Hash::check($request->current_password, $client->password)) {
            return Response::error([__('message.error_response_message')]);
        }
        $client->update(['password' => $request->password]);
        return Response::success(ProfileResource::make(auth('client-api')->user()));
    }
}
