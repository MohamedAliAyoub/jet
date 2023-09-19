<?php

namespace App\Actions\Api\UserLog;

use App\Classes\Response;
use App\Http\Resources\Trips\TripsResource;
use App\Http\Resources\UserLogs\UserLogsResource;
use App\Models\Trip;
use App\Models\UserLog;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUserLogsAction
{
    use AsAction;

    public function handle(): \Illuminate\Http\JsonResponse
    {
        $data = UserLog::query()
            ->where('user_id' , auth()->id())
            ->paginate(20);
        return Response::success(UserLogsResource::collection($data));
    }
}
