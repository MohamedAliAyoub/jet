<?php

namespace App\Actions\User\Dahboard;

use App\Models\Trip;
use App\Models\User;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class DashoardAction
{
    use AsAction;

    public function handle(): \Inertia\Response
    {

        $users = User::count();
        $travelers = User::query()->whereNull('parent_id')->count();
        $Relatives = User::query()->whereNotNull('parent_id')->count();
        return Inertia::render('Home', [
            'users_count' => User::count(),
            'travelers_count' => User::query()->whereNull('parent_id')->count(),
            'relatives_count' => User::query()->whereNotNull('parent_id')->count(),
            'trips' => Trip::query()
                ->where('is_active' , true)
                ->whereDate('date', '<', now())
                ->count(),
            'cancelled_trips' => Trip::query()
                ->where('is_active' , false)
                ->count(),

            'upcoming_trips' => Trip::query()
                ->whereDate('date', '>', now())
                ->count(),
        ]);
    }
}
