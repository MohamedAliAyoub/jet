<?php

namespace App\Actions\User\Trip;

use App\Enums\Abilities;
use App\Models\Trip;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class TripDeleteAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_TRIP_DELETE;


    public function handle(Trip $trip): \Illuminate\Http\RedirectResponse
    {
        $trip->delete();

        toastr()->success(__('message.success_response_message'));
        return back();
    }
}
