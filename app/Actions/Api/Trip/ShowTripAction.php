<?php

namespace App\Actions\Api\Trip;

use App\Classes\Response;
use App\Http\Resources\Trips\TripsResource;
use App\Models\Trip;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowTripAction
{
    use AsAction;

    public function handle(Trip $trip): \Illuminate\Http\JsonResponse
    {

        return Response::success(TripsResource::make($trip));
    }
}
