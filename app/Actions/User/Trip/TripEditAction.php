<?php

namespace App\Actions\User\Trip;

use App\Models\Trip;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class TripEditAction
{
    use AsAction;

    public function handle( Trip $trip): \Inertia\Response
    {
        return Inertia::render('Trip', [
            'data' => $trip,
        ]);

    }


}
