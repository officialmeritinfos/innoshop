<?php

use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\RecoverPassword;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('about',[HomeController::class,'about'])->name('about');
Route::get('search',[HomeController::class,'search'])->name('search');
Route::get('search-result',[HomeController::class,'searchResult'])->name('search.result');
Route::get('shop',[HomeController::class,'shop'])->name('shop');
Route::get('product/{id}/detail',[HomeController::class,'productDetail'])->name('product.detail');
Route::get('products/category/{slug}',[HomeController::class,'categoryProducts'])->name('products.category');
Route::get('contact',[HomeController::class,'contact'])->name('contact');
Route::get('tracking',[HomeController::class,'track'])->name('tracking');
Route::get('terms-conditions',[HomeController::class,'terms'])->name('terms');
Route::any('cart/{id}/add',[HomeController::class,'addToCart'])->name('cart.add');

//Cart
Route::get('carts',[HomeController::class,'cart'])->name('carts');
Route::delete('carts/item/{id}', [HomeController::class, 'removeCartItem'])->name('cart.item.remove');

Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::post('checkout/process', [HomeController::class, 'processCheckout'])->name('checkout.process');
    Route::get('checkout/bank', [HomeController::class, 'bank'])->name('checkout.bank');
});



Route::get('flight-booking',[HomeController::class,'flightBooking'])->name('flight-booking');
Route::post('flight-booking/process',[HomeController::class,'processFlightBooking'])->name('flight-booking.process');
//Services
Route::get('tour',[HomeController::class,'tour']);
Route::get('travel',[HomeController::class,'travel']);
Route::get('logistics',[HomeController::class,'logistics']);
Route::get('visa',[HomeController::class,'visa']);
Route::get('flight-tracking',[HomeController::class,'flightTracking']);

Route::post('tracking/package/process',[HomeController::class,'processPackage'])
    ->name('tracking.package.process');
Route::post('tracking/flight/process',[HomeController::class,'processFLight'])
    ->name('tracking.flight.process');


Route::get('tracking/flight/{pnr}/detail',[HomeController::class,'flightDetail'])->name('home.flight.detail');
Route::get('tracking/package/{ref}/detail',[HomeController::class,'packageDetail'])->name('home.package.detail');



//Flight Ticket Printing
Route::get('flight/flight-tickets/{id}/print', [FlightController::class, 'print'])->name('flight_tickets.print');
//Delivery Printing
Route::get('delivery/{id}/print', [DeliveryController::class, 'print'])->name('delivery.print');
