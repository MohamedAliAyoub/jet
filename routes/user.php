<?php

use Illuminate\Support\Facades\Route;
use App\Actions\User\Dahboard\DashoardAction;
use App\Actions\User\Dahboard\ChangeLanguage;
use App\Actions\User\Admin\{
    AdminIndexAction,
    AdminStoreAction,
    AdminUpdateAction,
    AdminDeleteAction,
    AdminChangeIsActiveAction,
    AdminEditProfileAction,
    AdminChangePasswordAction,
    AdminChangePasswordViewAction,
};

use App\Actions\User\Role\{
    RoleIndexAction,
    RoleCreateAction,
    RoleStoreAction,
    RoleUpdateAction,
    RoleEditAction,
    RoleDeleteAction,
};
use App\Actions\Client\{
    ClientIndexAction,
    ClientStoreAction,
    ClientShowAction,
    ClientCreateAction,
    ClientEditAction,
    ClientUpdateAction,
    ClientDeleteAction,
    ClientChangeIsActiveAction,
};
use App\Actions\BloodType\{
    BloodTypeIndexAction,
    BloodTypeStoreAction,
    BloodTypeCreateAction,
    BloodTypeEditAction,
    BloodTypeUpdateAction,
    BloodTypeDeleteAction,
    BloodTypeChangeIsActiveAction,
};
use App\Actions\City\{
    AreaIndexAction,
    CityIndexAction,
    CityStoreAction,
    CityCreateAction,
    CityEditAction,
    CityUpdateAction,
    CityDeleteAction,
    CityChangeIsActiveAction,
};
use App\Actions\Auth\{
    ForgotPasswordAction,
    ResetPasswordAction,
    LogoutAction
};

// add route has perfix => /admin %% as => user
Route::redirect('', 'admin/login');
Route::inertia('login', 'Auth/Login')->name('login.page');
Route::post('login', \App\Actions\Auth\LoginAction::class)->name('login');


Route::inertia('forgot-password', 'Auth/Forgot-password')->name('password.request');
Route::post('/forgot-password', ForgotPasswordAction::class)->name('password.email');
Route::post('/reset-password', [ResetPasswordAction::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {

    Route::get('home', DashoardAction::class)->name('home');
    Route::post('chang-lang', ChangeLanguage::class)->name('locale.update');
    Route::prefix('admins')->as('admins.')->group(function () {
        Route::get('/', AdminIndexAction::class)->name('index');
        Route::post('/', AdminStoreAction::class)->name('store');
        Route::get('/create', [AdminStoreAction::class, 'view_form'])->name('create');
        Route::get('/{admin}/edit', [AdminUpdateAction::class, 'view_form'])->name('edit');
        Route::post('{admin}/update', AdminUpdateAction::class)->name('update');
        Route::delete('/{admin}', AdminDeleteAction::class)->name('delete');
        Route::put('change-is-active/{admin}', AdminChangeIsActiveAction::class)->name('change_active');

    });

    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/edit-profile', [AdminEditProfileAction::class, 'view_form'])->name('edit.profile');
        Route::get('/change-password', AdminChangePasswordViewAction::class)->name('change.password.view');
        Route::post('/update-profile', AdminEditProfileAction::class)->name('update.profile');
        Route::post('/change-password', AdminChangePasswordAction::class)->name('change.password');
    });

    Route::prefix('roles')->as('role.')->group(function () {
        Route::get('', RoleIndexAction::class)->name('index');
        Route::post('', RoleStoreAction::class)->name('store');
        Route::get('create', RoleCreateAction::class)->name('create');
        Route::get('{role}/edit', RoleEditAction::class)->name('edit');
        Route::post('{role}', RoleUpdateAction::class)->name('update');
        Route::delete('{role}', RoleDeleteAction::class)->name('delete');
    });

    Route::post('logout', LogoutAction::class)->name('logout');
});



