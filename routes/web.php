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

Route::get('/',[HomeController::class,'index']);
Route::get('index',[HomeController::class,'index']);
Route::get('about',[HomeController::class,'about']);
Route::get('plans',[HomeController::class,'plans']);
Route::get('plan',[HomeController::class,'plans']);
Route::get('terms',[HomeController::class,'terms']);
Route::get('terms',[HomeController::class,'terms']);
Route::get('services',[HomeController::class,'services']);
Route::get('service/{id}/details',[HomeController::class,'serviceDetail'])
    ->name('service.details');
Route::get('estate/{id}/details',[HomeController::class,'serviceDetail'])
    ->name('estate.details');
Route::get('faqs',[HomeController::class,'faqs']);
Route::get('faq',[HomeController::class,'faqs']);
Route::get('security',[HomeController::class,'security']);
Route::get('estate',[HomeController::class,'estate']);
Route::get('contact',[HomeController::class,'contact']);
Route::get('loan',[HomeController::class,'loan']);
Route::get('privacy',[HomeController::class,'privacy']);
Route::get('career',[HomeController::class,'career']);
Route::get('buy-btc',[HomeController::class,'buyBtc']);
Route::get('register',[Register::class,'landingPage']);
//Services
Route::get('realestate',[HomeController::class,'realEstate']);
Route::get('retirement',[HomeController::class,'retirement']);
Route::get('stocks',[HomeController::class,'stocks']);
Route::get('nft',[HomeController::class,'nft']);
Route::get('forex',[HomeController::class,'forex']);
Route::get('gold',[HomeController::class,'gold']);
Route::get('agriculture',[HomeController::class,'agriculture']);


//Calculate return
Route::post('calculate-return',[HomeController::class,'calculateReturn'])
    ->name('calculate.return');


//Flight Ticket Printing
Route::get('flight/flight-tickets/{id}/print', [FlightController::class, 'print'])->name('flight_tickets.print');
//Delivery Printing
Route::get('delivery/{id}/print', [DeliveryController::class, 'print'])->name('delivery.print');
