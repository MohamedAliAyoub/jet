<?php

namespace App\Actions\User\Dahboard;


use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ChangeLanguage
{
    use AsAction;

    public function handle(ActionRequest $request)
    {
        $request->session()->put('locale', $request->language);
        app()->setLocale(session('locale'));
        return back();
    }
}
