<?php

namespace App\Actions\User\Dahboard;

use App\Enums\UserTypeEnum;
use App\Models\Trip;
use App\Models\User;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class DashoardAction
{
    use AsAction;

    public function handle(): \Inertia\Response
    {
        if (auth()->user()->roles()->first()?->name == UserTypeEnum::TRAVELLER) {
            return $this->home_travellers();
        }
        if (auth()->user()->roles()->first()?->name == UserTypeEnum::RELATIVE->value) {
            return $this->home_travellers(auth()->user()->parent_id);
        }

        return $this->home_admins();

    }

    public function home_admins(): \Inertia\Response
    {

        return Inertia::render('Home', [
            'users_count' => User::count(),
            'travelers_count' => User::query()->whereHas('roles', function ($q) {
                $q->where('name', 'traveller');
            })->whereNull('parent_id')->count(),
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
        if (!$user_id)
            $user_id = auth()->id();

        $user = User::find($user_id);
        return Inertia::render('HomeTravellers', [
            'total_hours' =>$user->hours_balance,
            'hours' => $user->hours_number,
            'trips' => Trip::query()
                ->where('user_id', $user_id)
                ->where('is_active', true)
                ->count(),
            'next_trips' => Trip::query()
                ->where('user_id', $user_id)
                ->whereDate('date', '<', now())
                ->where('is_active', true)
                ->count(),

        ]);
    }
}
