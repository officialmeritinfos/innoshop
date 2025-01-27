<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\User\Dashboard;
use App\Http\Controllers\User\Deposits;
use App\Http\Controllers\User\Investments;
use App\Http\Controllers\User\ManagedAccounts;
use App\Http\Controllers\User\Referrals;
use App\Http\Controllers\User\Settings;
use App\Http\Controllers\User\Transfers;
use App\Http\Controllers\User\Withdrawals;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your web.
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
| To access this endpoint, the prefix 'account' has to be added.
| You can change this in the RouteServiceProvider file
|
*/


Route::get('dashboard',[Dashboard::class,'landingPage'])->name('user.dashboard');

/*================ Order ROUTE ====================*/
Route::get('orders',[Dashboard::class,'landingPage'])->name('orders.index');
/*================ SETTINGS ROUTE ====================*/
Route::get('settings',[Settings::class,'landingPage'])->name('setting.index');
Route::post('update-settings',[Settings::class,'processSetting'])->name('settings.update');
Route::post('update-password',[Settings::class,'processPassword'])->name('password.update');

Route::get('logout',[Login::class,'logout'])->name('user.logout');
