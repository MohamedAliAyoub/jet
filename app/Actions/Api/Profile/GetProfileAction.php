<?php

namespace App\Actions\Api\Profile;

use App\Classes\Response;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\User\AuthUserResource;
use Lorisleiva\Actions\Concerns\AsAction;

class GetProfileAction
{
    use AsAction;

    public function handle(): \Illuminate\Http\JsonResponse
    {
        $data = auth()->user();
        return Response::success(AuthUserResource::make($data));
    }
}
