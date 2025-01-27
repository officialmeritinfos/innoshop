<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Coins;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\DeliveryStageController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Admin\UserController;
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
Route::get('delivery/{id}/user',[DeliveryController::class,'userDetails'])->name('delivery.user.detail');
//Add Delivery
Route::get('delivery/new',[DeliveryController::class,'newDelivery'])->name('delivery.new');
Route::post('delivery/new/process',[DeliveryController::class,'processNewDelivery'])->name('delivery.new.process');
//Edit Delivery
Route::get('delivery/{id}/edit',[DeliveryController::class,'edit'])->name('delivery.edit');
Route::post('delivery/{id}/edit/process',[DeliveryController::class,'update'])->name('delivery.edit.process');
//Delete
Route::delete('delivery/{id}', [DeliveryController::class, 'destroy'])->name('delivery.delete');
/*=================== DELIVERY STAGE ===================== */
Route::get('delivery/{id}/stages/new', [DeliveryStageController::class, 'create'])->name('delivery.stage.new');
Route::post('delivery/{id}/stages', [DeliveryStageController::class, 'store'])->name('delivery.stage.store');
Route::get('delivery/stage/{id}/edit', [DeliveryStageController::class, 'edit'])->name('delivery.stage.edit');
Route::post('delivery/stage/{id}', [DeliveryStageController::class, 'update'])->name('delivery.stage.update');
Route::delete('delivery/stage/{id}', [DeliveryStageController::class, 'destroy'])->name('delivery.stage.delete');
/*===================FLIGHT ROUTE ========================*/
Route::get('flight/index',[FlightController::class,'landingPage'])->name('flight.index');
//create
Route::get('flight/flight-tickets/create', [FlightController::class, 'create'])->name('flight_tickets.create');
Route::post('flight/flight-tickets', [FlightController::class, 'store'])->name('flight_tickets.store');
//edit
Route::get('flight/flight-tickets/{id}/edit', [FlightController::class, 'edit'])->name('flight_tickets.edit');
Route::put('flight/flight-tickets/{id}', [FlightController::class, 'update'])->name('flight_tickets.update');
//display
Route::get('flight/flight-tickets/{id}', [FlightController::class, 'show'])->name('flight_tickets.show');
//Delete
Route::delete('flight/flight-tickets/{id}', [FlightController::class, 'destroy'])->name('flight_tickets.destroy');
//Flight Booking
Route::get('flight/booking/index',[FlightController::class,'bookings'])->name('flight.booking.index');
/*================ CATEGORY ROUTE ====================*/
Route::get('category/index', [CategoryController::class, 'landingPage'])->name('category.index');
Route::post('category/new/process', [CategoryController::class, 'addCategory'])->name('category.new.process');
Route::get('category/{id}/details', [CategoryController::class, 'categoryDetail'])->name('category.details');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');//update
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');//delete
/*================ PRODUCT ROUTE ====================*/
Route::get('products/index', [ProductController::class, 'landingPage'])->name('products.index');
Route::get('products/new', [ProductController::class, 'newProduct'])->name('products.new');
Route::post('products/new/process', [ProductController::class, 'processNewProduct'])->name('products.new.process');
Route::get('products/{id}/edit', [ProductController::class, 'editProduct'])->name('products.edit');
Route::get('products/{id}/detail', [ProductController::class, 'productDetail'])->name('products.detail');
Route::put('products/{id}/update', [ProductController::class, 'updateProduct'])->name('products.update');//update
Route::delete('products/{id}', [ProductController::class, 'deleteProduct'])->name('products.destroy');//delete
Route::put('products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');// Toggle Product Status
/*================ ORDER ROUTE ====================*/
Route::get('orders/index', [OrderController::class, 'landingPage'])->name('orders.index');
Route::get('orders/{id}/detail', [OrderController::class, 'orderDetail'])->name('orders.detail');
Route::put('orders/{id}/mark-payment', [OrderController::class, 'markPayment'])->name('orders.markPayment');
Route::get('orders/{id}/mark-completed', [OrderController::class, 'markCompleted'])->name('orders.markCompleted');
Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
/*================ USER ROUTE ====================*/
Route::get('users/index', [UserController::class, 'landingPage'])->name('users.index');
Route::get('users/{id}/edit', [UserController::class, 'landingPage'])->name('users.edit');
Route::get('users/{id}/detail', [UserController::class, 'landingPage'])->name('users.detail');

//Logout
Route::get('logout',[Login::class,'logout']);
