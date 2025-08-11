<?php

namespace App\Infrastructure\Mail\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;

    public function __construct(string $otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Xác thực tài khoản')
                    ->view('layouts.Auth.emails.otp')
                    ->with([
                        'otp' => $this->otp
                    ]);
    }
}
