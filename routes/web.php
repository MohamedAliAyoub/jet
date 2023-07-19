<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::inertia('/', 'Auth/welcome')->name('welcome.page');
Route::get('/reset-password/{token}',\App\Actions\Auth\ResetPasswordAction::class)->name('password.reset');





