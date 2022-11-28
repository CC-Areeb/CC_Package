<?php

namespace CooperativeComputingSMS;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        dd(
            copy(__DIR__.'/SmsServiceProvider.php', app_path('Http/Controllers/SMSController.php'))
        );
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'cc-sms');
        $this->publishes([
            __DIR__.'/../config/sms.php' => config_path('sms.php'),
        ], 'CC-SMS');

        Route::prefix('sms')->group(function () {
            Route::get('/', [SMSController::class, 'SMSindex'])->name('SMSindex');
            Route::post('/send', [SMSController::class, 'sendSMS'])->name('sendSMS');
        });

        $this->commands([
            Console\SmsCommand::class,
        ]);
    }
}