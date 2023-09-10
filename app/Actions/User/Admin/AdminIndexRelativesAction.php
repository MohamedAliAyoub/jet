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


class AdminIndexRelativesAction
{
    use AsAction;

    protected Abilities $ability = Abilities::MODULE_ADMINS_INDEX_RELATIVES;

    /**
     * the ability name to authorize by \App\Traits\Authorizeable trait.
     *
     * @var string
     */

    public function handle(ActionRequest $request , User $admin): \Symfony\Component\HttpFoundation\BinaryFileResponse|\Inertia\Response|\Inertia\ResponseFactory
    {
        $data = User::query()
            ->where('parent_id' , $admin->id)
            ->with('roles')
            ->search()
        ->orderByDesc('id')
        ->paginate();

        $loggedInUserId = auth()->id();
        $superAdminEmail = User::SUPERADMIN_EMAIL;

        $usersNotActions = User::query()
            ->whereIn('id', [$loggedInUserId, $superAdminEmail])
            ->pluck('id');

        if (isset($request['export_excel']) && $request['export_excel'] == true) {
            return Excel::download(new AdminsExport, 'users_' . Carbon::now()->toDateString() . '.xlsx');

        }
        return inertia('Admin/Index', [
            'data' => $data,
        ]);
    }
}
