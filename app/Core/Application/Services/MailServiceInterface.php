<?php

namespace App\Core\Application\Services;

interface MailServiceInterface
{
    public function sendOtp(string $to, string $otp): void;
}
