<?php

use Illuminate\Support\Facades\Route;


use App\Actions\Api\Client\{
    ClientRegisterAction,
    ClientLoginAction,
    ClientLogoutAction,
    GetRegisteredDataAction,
};

Route::group(['middleware' => ['setLanguage']], function () {

    Route::post('login', \App\Actions\Api\Auth\ClientLoginAction::class);
    Route::group(['middleware' => ['auth:api']], function () {

        Route::post('logout', \App\Actions\Api\Auth\ClientLogoutAction::class);
        Route::get('profile', \App\Actions\Api\Profile\GetProfileAction::class);
        Route::get('terms', \App\Actions\Api\Profile\GetTermsAction::class);
        Route::post('update_fcm_token', \App\Actions\Api\Auth\ClientUpdateFCMTokenAction::class);
        Route::prefix('trips')->as('trips.')->group(function () {
            Route::get('', \App\Actions\Api\Trip\GetTripsAction::class);
            Route::get('/{trip}', \App\Actions\Api\Trip\ShowTripAction::class);

        });
        Route::prefix('user_notifications')->as('user_notifications.')->group(function () {
            Route::get('', \App\Actions\Api\UserLog\GetUserLogsAction::class);
        });
    });



});
