<?php

namespace CooperativeComputingSMS\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class SmsCommand extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will install the SMS resources';

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $this->AddSmsRoute();
        $this->AddSmsViews();
        $this->AddSmsController();
    }

    // Routes
    public function AddSmsRoute()
    {
        (new Filesystem)->ensureDirectoryExists(base_path('routes'));
        copy(__DIR__.'/../routes/web.php', base_path('routes/sms.php'));
    }

    // Controllers
    public function AddSmsController()
    {
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        copy(__DIR__.'/../Http/Controllers/SMSController.php', app_path('Http/Controllers/SMSController.php'));
    }

    // Views
    public function AddSmsViews()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        copy(__DIR__.'/../../resources/views/sms-welcome.blade.php', resource_path('views/sms-welcome.blade.php'));
        copy(__DIR__.'/../../resources/views/sms-index.blade.php', resource_path('views/sms-index.blade.php'));
    }
}
