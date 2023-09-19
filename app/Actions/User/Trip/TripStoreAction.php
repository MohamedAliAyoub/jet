<?php

namespace App\Actions\User\Trip;

use App\Enums\Abilities;
use App\Enums\TripStatusEnum;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Trip\CreateTripRequest;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use App\Services\UserLogService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class TripStoreAction
{
    protected Abilities $ability = Abilities::MODULE_TRIP_CREATE;

    use AsAction;
    private $userLogService;

    public function __construct(UserLogService $userLogService)
    {
        $this->userLogService = $userLogService;
    }

    public function handle(CreateTripRequest $request): \Illuminate\Http\RedirectResponse
    {

        if (User::find($request->user_id)->hours <= 0){
            toastr()->error(__('message.error_response_message'));
            return back();
        }

        $trip = Trip::query()->create($request->validated());

        $this->userLogService->createLog( __('message.trip_title', ['arrival_country' => $trip->arrival_country]), __('message.trip_message', ['created_at' => $trip->created_at]), auth()->user()->id);

        //Discount of flight hours for the user
        $unused_hours = $trip->user->hours - $trip->hours;
        $trip->user->update(['hours' => $unused_hours]);

        toastr()->success(__('message.success_response_message'));
        return Redirect::route('user.trips.index');
    }

    public function view_form(): \Inertia\Response
    {
        return Inertia::render('Trip/Form', [
            'status' => TripStatusEnum::getOptionsData(),
        ]);
    }
}
