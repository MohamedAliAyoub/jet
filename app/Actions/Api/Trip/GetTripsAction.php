<?php

namespace App\Actions\Api\Trip;

use App\Classes\Response;
use App\Http\Resources\Trips\TripsResource;
use App\Models\Trip;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTripsAction
{
    use AsAction;

    public function handle(): \Illuminate\Http\JsonResponse
    {
        $data = Trip::query()
            ->where('user_id' , auth()->id())
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear()->month(2)->subYear(), // Start from last February
                Carbon::now()->startOfYear()->month(2)->addYear(), // End at next February
            ])
            ->search()
            ->searchDate()
            ->newTrips()
            ->paginate(20);
        return Response::success(TripsResource::collection($data));
    }
}
