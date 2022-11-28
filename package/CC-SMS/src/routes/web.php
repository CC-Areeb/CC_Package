<?php

namespace CooperativeComputingSMS;

use CooperativeComputingSMS\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Route;

Route::prefix('sms')->group(function () {
    Route::get('/', [SMSController::class, 'SMSindex'])->name('SMSindex');
    Route::post('/send', [SMSController::class, 'sendSMS'])->name('sendSMS');
}); 