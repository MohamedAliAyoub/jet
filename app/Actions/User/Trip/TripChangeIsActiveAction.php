<?php

namespace App\Actions\User\Trip;

use App\Enums\Abilities;
use App\Models\Trip;
use Lorisleiva\Actions\Concerns\AsAction;

class TripChangeIsActiveAction
{
    use AsAction;
    protected Abilities $ability = Abilities::MODULE_TRIP_ACTIVE;

    public function handle(Trip $trip): \Illuminate\Http\RedirectResponse
    {
        $trip->is_active = ! $trip->is_active;

        $trip->save();

        toastr()->success(__('message.success_response_message'));
        return back();
    }
}
