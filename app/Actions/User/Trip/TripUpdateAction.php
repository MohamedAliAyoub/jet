<?php

namespace App\Actions\User\Trip;

use App\Enums\Abilities;
use App\Http\Requests\Trip\CreateTripRequest;
use App\Models\Trip;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class TripUpdateAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_TRIP_UPDATE;

    public function handle(CreateTripRequest $request, Trip $trip): \Illuminate\Http\RedirectResponse
    {

        if (isset($request->hours)){
            $unused_hours = $trip->user->hours + $trip->hours - $request->hours;


            $trip->user->update(['hours' => $unused_hours]);
            if ( $trip->user->hours <= 0){
                toastr()->error(__('message.error_response_message'));
                return back();
            }
        }
        $trip->update($request->validated() );
        toastr()->success(__('message.success_response_message'));
        return back();

    }

}
