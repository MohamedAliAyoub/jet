<?php

namespace App\Actions\Api\Profile;

use App\Classes\Response;
use App\Http\Requests\Api\Profile\EditProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Client;
use Lorisleiva\Actions\Concerns\AsAction;

class EditProfileAction
{
    use AsAction;

    public function handle(EditProfileRequest $request): \Illuminate\Http\JsonResponse
    {
         $client = Client::query()
            ->find(auth('client-api')->user()->id);
            $client->update($request->validated());
        return Response::success(ProfileResource::make($client));
    }
}
