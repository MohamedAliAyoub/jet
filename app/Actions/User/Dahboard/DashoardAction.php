<?php

namespace App\Actions\User\Dahboard;

use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class DashoardAction
{
    use AsAction;

    public function handle()
    {
        return Inertia::render('Home');
    }
}
