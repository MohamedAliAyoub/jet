<?php

namespace App\Actions\Api\Profile;

use App\Classes\Response;
use App\Http\Resources\Terms\TermsResource;
use App\Models\ConfigValues;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTermsAction
{
    use AsAction;

    public function handle(): \Illuminate\Http\JsonResponse
    {
        $data = ConfigValues::query()->whereIn('name' , ['terms' ])->get();
        return Response::success(TermsResource::collection($data));
    }
}
