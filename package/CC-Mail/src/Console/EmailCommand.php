<?php

namespace CooperativeComputing\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class EmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will install the Email resources';

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        // Controllers
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        copy(__DIR__.'/../Http/Controllers/EmailController.php', app_path('Http/Controllers/EmailController.php'));

        // Mailables
        (new Filesystem)->ensureDirectoryExists(app_path('Mail'));
        copy(__DIR__.'/../Mail/Emails.php', app_path('Mail/Emails.php'));

        // Views
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        copy(__DIR__.'/../../resources/views/emailWelcome.blade.php', resource_path('views/email-welcome.blade.php'));
        copy(__DIR__.'/../../resources/views/email-index.blade.php', resource_path('views/email-index.blade.php'));

        // Routes
        (new Filesystem)->ensureDirectoryExists(base_path('routes'));
        copy(__DIR__.'/../routes/web.php', base_path('routes/email.php'));
    }
}