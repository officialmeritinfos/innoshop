<?php

use App\Http\Controllers\Admin\Coins;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\Deposits;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\Investments;
use App\Http\Controllers\Admin\Investors;
use App\Http\Controllers\Admin\ManagedAccountDurations;
use App\Http\Controllers\Admin\ManagedAccounts;
use App\Http\Controllers\Admin\Notifications;
use App\Http\Controllers\Admin\Packages;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Admin\Transfers;
use App\Http\Controllers\Admin\WebSettings;
use App\Http\Controllers\Admin\Withdrawals;
use App\Http\Controllers\Auth\Login;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your web.
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
| To access this endpoint, the prefix 'admin' has to be added.
| You can change this in the RouteServiceProvider file
|
*/


Route::get('dashboard',[Dashboard::class,'landingPage'])->name('admin.dashboard');
/*================ SETTINGS ROUTE ====================*/
Route::get('settings',[Settings::class,'landingPage'])->name('setting.index');
Route::post('update-settings',[Settings::class,'processSetting'])->name('settings.update');
Route::post('update-password',[Settings::class,'processPassword'])->name('password.update');
/*===================DELIVERY ROUTE ========================*/
Route::get('delivery/index',[DeliveryController::class,'landingPage'])->name('delivery.index');
Route::get('delivery/{reference}/detail',[DeliveryController::class,'deliveryDetail'])->name('delivery.detail');
//Add Delivery
Route::get('delivery/new',[DeliveryController::class,'newDelivery'])->name('delivery.new');
Route::post('delivery/new/process',[DeliveryController::class,'processNewDelivery'])->name('delivery.new.process');
//Edit Delivery
Route::get('delivery/{id}/edit',[DeliveryController::class,'edit'])->name('delivery.edit');
Route::post('delivery/{id}/edit/process',[DeliveryController::class,'update'])->name('delivery.edit.process');

//Delete
Route::delete('delivery/{id}', [DeliveryController::class, 'destroy'])->name('delivery.delete');

/*===================FLIGHT ROUTE ========================*/
Route::get('flight/index',[FlightController::class,'landingPage'])->name('flight.index');


//Logout
Route::get('logout',[Login::class,'logout']);
