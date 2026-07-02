<?php

use Illuminate\Support\Facades\Route;
use Zerp\Twilio\Http\Controllers\TwilioSettingsController;

Route::middleware(['web', 'auth', 'verified', 'PlanModuleCheck:Twilio'])->group(function () {
    Route::get('twilio/settings', [TwilioSettingsController::class, 'index'])->name('twilio.settings.index');
    Route::post('twilio/settings/store', [TwilioSettingsController::class, 'store'])->name('twilio.settings.store');
});
