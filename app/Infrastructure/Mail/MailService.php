<?php

namespace App\Infrastructure\Mail;

use App\Core\Application\Services\MailServiceInterface;
use Illuminate\Support\Facades\Mail;
use App\Infrastructure\Mail\Mails\OtpMail;

class MailService implements MailServiceInterface
{
    public function sendOtp(string $to, string $otp): void
    {
        Mail::to($to)->send(new OtpMail($otp));
    }
}
