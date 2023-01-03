<?php

namespace CooperativeComputing\Services;

use Illuminate\Support\ServiceProvider;
use CooperativeComputing\Console;

class EmailingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/email.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'cc-email');
        $this->publishes([
            __DIR__.'/../config/email.php' => config_path('email.php'),
        ], 'CC-Emails');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\EmailCommand::class
            ]);
        }
    }
}
