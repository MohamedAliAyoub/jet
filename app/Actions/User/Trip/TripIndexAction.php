<?php

namespace App\Actions\User\Trip;


use App\Enums\Abilities;
use App\Enums\TripStatusEnum;
use App\Exports\TripsExport;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Maatwebsite\Excel\Facades\Excel;


class TripIndexAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_TRIP_INDEX;

    /**
     * the ability name to authorize by \App\Traits\Authorizeable trait.
     *
     * @var string
     */

    public function handle(ActionRequest $request): \Symfony\Component\HttpFoundation\BinaryFileResponse|\Inertia\Response|\Inertia\ResponseFactory
    {

        $data = Trip::query()
            ->search()
            ->traveller()
            ->with('user')
            ->orderByDesc('id')
            ->paginate(5);

        if (isset($request['export_excel'])) {
            return Excel::download(new TripsExport(), 'trips_' . Carbon::now()->toDateString() . '.xlsx');

        }
        return inertia('Trip/Index', [
            'data' => $data,
            'statuses' => TripStatusEnum::getOptionsData(),
            'users' => User::query()->whereNull('parent_id')->get(['id', 'name'])
        ]);
    }
}
