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

        if (User::find($request->user_id)->hours <= 0) {
            toastr()->error(__('message.error_response_message'));
            return back();
        }
        $data = $request->validated();
        $trip = Trip::query()->create($data);

        $this->notification($trip);

        //Discount of flight hours for the user
        $unused_hours = $trip->user->hours - (($trip->hours *60) + $trip->minutes ) ;
        $trip->user->update(['hours' => $unused_hours]);

        toastr()->success(__('message.success_response_message'));
        return Redirect::route('user.trips.index');
    }

    public function notification($trip): void
    {
        if (isset( $trip->user_id))
        {
            $this->userLogService->createLog(
                [
                    'en' => 'trip in ' . $trip->arrival_country,
                    'ar' => 'رحلة الى ' . $trip->arrival_country],
                [
                    'en' => 'You have a flight in  ' . $trip->arrival_country . '  on ' . $trip->date,
                    'ar' => 'لديك رحلة الى ' . $trip->arrival_country . '  بتاريخ' . $trip->date
                ],
                $trip->user_id
            );
        }

    }

}
