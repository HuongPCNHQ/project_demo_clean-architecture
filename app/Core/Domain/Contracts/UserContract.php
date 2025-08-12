<?php

namespace App\Core\Domain\Contracts;
use App\Core\Domain\Entities\UserEntity;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserContract {
    public function validateLogin(?UserEntity $user, string $password): void
    {
        if (!$user) {
            throw new Exception("Email không tồn tại");
        }

        if (!$user->is_active) {
            throw new Exception("Tài khoản chưa được kích hoạt");
        }
        if (!Hash::check($password, $user->password)) {
            throw new Exception("Mật khẩu không đúng");
        }
    }

    public function validateForgot(?UserEntity $user): void
    {
        if (!$user) {
            throw new Exception("Email không tồn tại");
        }

        if (!$user->is_active) {
            throw new Exception("Tài khoản chưa được kích hoạt");
        }
    }

    
}