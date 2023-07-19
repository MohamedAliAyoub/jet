<?php

namespace App\Actions\User\Admin;


use App\Enums\Abilities;
use App\Exports\AdminsExport;
use App\Exports\ExcelExport;
use App\Models\User;
use Carbon\Carbon;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Maatwebsite\Excel\Facades\Excel;


class AdminIndexAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_ADMINS_INDEX;

    /**
     * the ability name to authorize by \App\Traits\Authorizeable trait.
     *
     * @var string
     */

    public function handle(ActionRequest $request)
    {
        $data = User::query()
            ->with('roles')
            ->search()
        ->orderByDesc('id')
        ->paginate();
        $usersNotActions = User::query()
            ->where('id', auth()->id())
            ->orWhere('email' , 'info@save4.com')->get()->pluck('id');
//        dd($usersNotActions);
        if (isset($request['export_excel']) && $request['export_excel'] == true) {
            return Excel::download(new AdminsExport, 'admins_' . Carbon::now()->toDateString() . '.xlsx');

        }
        return inertia('Admin/Index', [
            'data' => $data,
        ]);
    }
}
