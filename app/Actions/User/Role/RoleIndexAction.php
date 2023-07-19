<?php

namespace App\Actions\User\Role;


use App\Enums\Abilities;
use App\Exports\ExcelExport;
use App\Exports\RolesExport;
use App\Models\Role;
use Carbon\Carbon;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Maatwebsite\Excel\Facades\Excel;


class RoleIndexAction
{
    use AsAction;
    protected Abilities $ability = Abilities::MODULE_ROLE_INDEX;

    /**
     * the ability name to authorize by \App\Traits\Authorizeable trait.
     *
     * @var string
     */

    public function handle(ActionRequest $request)
    {
        $data = Role::query()
                    ->search()
                    ->orderByDesc('id')
                    ->paginate();

        if (isset($request['export_excel']) && $request['export_excel'] == true) {
            return Excel::download(new RolesExport(), 'roles_' . Carbon::now()->toDateString() . '.xlsx');
        }
        return inertia('Role/Index', [
            'data' => $data,
        ]);
    }
}
