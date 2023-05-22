<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailJob;
use App\Mail\MailNewUser;
use Illuminate\Console\Command;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new SendEmailJob('destination@example.com', new MailNewUser))->handle();
    }
}
