<?php

use App\Http\Controllers\HubSpotController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;


Route::get('stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.pay');

Route::resource('hubspot', HubSpotController::class);
