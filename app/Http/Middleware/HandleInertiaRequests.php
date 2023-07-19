<?php

namespace App\Http\Middleware;

use App\Classes\Menu;
use App\Http\Resources\User\AuthUserResource;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * the abilities of authed user.
     *
     * @var mixed
     */
    protected $userAbilities = [];

    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        $this->setUserAbilitiesIfAuthed($user);

        return array_merge(parent::share($request), [
            "asset_url"     => asset('image'),
            'locale'        => app()->getLocale(),
            'auth'          => $user ? (AuthUserResource::make($user))->toArray($request) : NULL,
            'permissions'   => $this->userAbilities,
            'menu'          => Menu::getMenu(),
            'toastr'        => $this->getToastrEnvelopesFromSession($request),
            'flashProp'     => $request->session()->pull('flashProp'),
        ]);
    }

    protected function setUserAbilitiesIfAuthed(?Authenticatable $user): void
    {
        if($user) {
            $this->userAbilities = $user->getAbilities()->pluck('name')->toArray();
        }

        session()->put('userAbilities', $this->userAbilities);
    }

    protected function getToastrEnvelopesFromSession($request)
    {
        return collect($request->session()->pull('flasher::envelopes'))
                ->map(function($item) {
                    $notification = $item->getNotification();
                    return [
                        'type' => $notification->getType(),
                        'message' => $notification->getMessage(),
                    ];
                });
    }
}
