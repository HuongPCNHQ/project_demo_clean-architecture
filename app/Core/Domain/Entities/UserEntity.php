<?php

namespace App\Core\Domain\Entities;

use Carbon\Carbon;

class UserEntity{
    public ?int $id;
    public ?string $name;
    public ?string $phone;
    public ?string $email;
    public ?Carbon $email_verified_at;
    public ?string $password;
    public ?string $remember_token;
    //xác thực otp
    public ?int $is_active;
    public ?string $otp_code;
    public ?Carbon $otp_expires_at;
    //xác thực 2fa
    public ?string $two_fa_secret;
    public bool $two_fa_enabled;

    public ?Carbon $created_at;
    public ?Carbon $updated_at;

    public function __construct(array $data)
    {
        $this -> id = $data['id'] ?? null;
        $this -> name = $data['name'] ?? null;
        $this -> phone = $data['phone'] ?? null;
        $this -> email = $data['email'] ?? null;
        $this -> email_verified_at = isset($data['email_verified_at']) ? new Carbon($data['email_verified_at']) : null;
        $this -> password = $data['password'] ?? null;
        $this -> remember_token = $data['remember_token'] ?? null;
        $this->is_active = $data['is_active'] ?? 0;
        $this -> otp_code = $data['otp_code'] ?? null;
        $this -> otp_expires_at = isset($data['otp_expires_at']) ? new Carbon($data['otp_expires_at']) : null;
        $this -> two_fa_secret = $data['two_fa_secret'] ?? null;
        $this -> two_fa_enabled = $data['two_fa_enabled'] ?? false;
        $this -> created_at = isset($data['created_at']) ? new Carbon($data['created_at']) : null;
        $this -> updated_at = isset($data['updated_at']) ? new Carbon($data['updated_at']) : null;
    } 
}