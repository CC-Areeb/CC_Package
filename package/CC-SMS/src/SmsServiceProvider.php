<?php

namespace CooperativeComputingSMS;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'cc-sms');
        $this->publishes([
            __DIR__.'/../config/sms.php' => config_path('sms.php'),
        ], 'CC-SMS');

        $this->commands([
            Console\SmsCommand::class,
        ]);
    }
}