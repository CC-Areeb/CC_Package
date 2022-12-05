<?php

namespace CooperativeComputingSMS\Services;

use Illuminate\Support\ServiceProvider;
use CooperativeComputingSMS\Console;



class SmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'cc-sms');
        $this->publishes([
            __DIR__.'/../config/sms.php' => config_path('sms.php'),
        ], 'CC-SMS');
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\SmsCommand::class,
            ]);
        }
    }
}