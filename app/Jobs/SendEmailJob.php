<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailJob
{
    use Dispatchable, SerializesModels;

    public function __construct(
        protected string   $to,
        protected Mailable $mailable,
    ) {
        $this->readEmailConfig();
    }

    public static function send(string $to, Mailable $mailable)
    {
        (new self($to, $mailable))->handle();
    }

    private function readEmailConfig()
    {
        $settings = DB::table('email_settings')->select('email', 'name')->first();

        $config = [
            'transport'   => config('mail.mailers.smtp.transport'),
            'host'        => config('mail.mailers.smtp.host'),
            'port'        => config('mail.mailers.smtp.port'),
            'timeout'     => null,
            'encryption'  => config('mail.mailers.smtp.encryption'),
            'username'    => config('mail.mailers.smtp.username'),
            'password'    => config('mail.mailers.smtp.password'),
            'from'        => [
                'address' => $settings->email,
                'name'    => $settings->name,
            ],
        ];

        Config::set('mail.mailers.smtp', $config);
    }

    public function handle()
    {
        Mail
            ::to($this->to)
            ->send($this->mailable);
    }
}