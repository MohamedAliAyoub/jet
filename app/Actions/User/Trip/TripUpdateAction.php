<?php

namespace App\Actions\User\Trip;

use App\Enums\Abilities;
use App\Http\Requests\Trip\CreateTripRequest;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class TripUpdateAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_TRIP_UPDATE;

    public function handle(CreateTripRequest $request, Trip $trip): \Illuminate\Http\RedirectResponse
    {
        if (isset($request->hours) || isset($request->minutes)) {

            $this->update_hours_user($request->hours, $request->minutes, $trip);
        }


        $data = $request->validated();


//        dd($data);
        $trip->update($data);
        toastr()->success(__('message.success_response_message'));
        return back();
    }

    public function update_hours_user($hours, $minutes, $trip)
    {
        $updated_duration = intval($hours) * 60 + intval($minutes);

        $old_duration = intval($trip->hours) * 60 + intval($trip->minutes);

        $unused_hours = $trip->user->hours + $updated_duration - $old_duration;


        $trip->user->update(['hours' => $unused_hours]);
        if ($trip->user->hours <= 0) {
            toastr()->error(__('message.error_response_message'));
            return back();
        }

    }

}
