<?php

namespace CooperativeComputing;

use Illuminate\Support\ServiceProvider;

class EmailingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'cc-email');
        $this->publishes([
            __DIR__.'/../config/email.php' => config_path('email.php'),
        ], 'CC-Emails');

        $this->commands([
            Console\EmailCommand::class,
        ]);
    }
}
