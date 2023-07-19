<?php

use Illuminate\Support\Facades\Route;


use App\Actions\Api\Client\{
    ClientRegisterAction,
    ClientLoginAction,
    ClientLogoutAction,
    GetRegisteredDataAction,
};

Route::group(['middleware' => ['setLanguage']], function () {


});
