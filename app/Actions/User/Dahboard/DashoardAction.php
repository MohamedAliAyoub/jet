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
        if (auth()->user()->roles()->first()?->name == 'traveller') {
            return $this->home_travellers();
        }
        if (auth()->user()->roles()->first()?->name == 'relative') {
            return $this->home_travellers(auth()->user()->parent_id);
        }

        return $this->home_admins();

    }

    public function home_admins(): \Inertia\Response
    {

        return Inertia::render('Home', [
            'users_count' => User::count(),
            'travelers_count' => User::query()->whereNull('parent_id')->count(),
            'relatives_count' => User::query()->whereNotNull('parent_id')->count(),
            'trips' => Trip::query()
                ->where('is_active', true)
                ->count(),
            'cancelled_trips' => Trip::query()
                ->where('is_active', false)
                ->count(),

            'upcoming_trips' => Trip::query()
                ->whereDate('date', '>', now())
                ->count(),
        ]);
    }

    public function home_travellers($user_id = null): \Inertia\Response
    {
        if ($user_id == null)
            $user_id = auth()->id();
        $relatives_count = User::query()
            ->where('parent_id', $user_id)
            ->whereNotNull('parent_id')
            ->count();
        $trips = Trip::query()
            ->where('user_id', $user_id)
            ->where('is_active', true)
            ->count();
        $next_trips = Trip::query()
            ->where('user_id', $user_id)
            ->whereDate('date', '<', now())
            ->where('is_active', true)
            ->count();
        $cancelled_trips = Trip::query()
            ->where('user_id', $user_id)
            ->where('is_active', false)
            ->count();

        return Inertia::render('Home', [
            $relatives_count,
            $trips,
            $next_trips,
            $cancelled_trips,
        ]);
    }
}
