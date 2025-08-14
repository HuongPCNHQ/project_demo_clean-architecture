<?php

namespace App\Core\Domain\Contracts;
use App\Core\Domain\Entities\UserEntity;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserContract {

    //contract auth
    public function validateLogin(?UserEntity $user, string $password): void
    {
        if (!$user) {
            throw new Exception("Email không tồn tại");
        }

        if (!$user->is_active) {
            throw new Exception("Tài khoản chưa được kích hoạt");
        }

        if ($user->is_lock) {
            throw new Exception("Tài khoản bị khoá vui lòng liên hệ cho quản trị viên");
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

    //contract frontend
    public function validateChangePassword(?UserEntity $user, string $currentPassword, string $newPassword): void
    {
        if (!$user) {
            throw new \Exception("Người dùng không tồn tại");
        }
        if (!Hash::check($currentPassword, $user->password)) {
            throw new Exception("Mật khẩu hiện tại không đúng");
        }

        if ($currentPassword === $newPassword) {
            throw new Exception("Mật khẩu mới không được trùng mật khẩu hiện tại");
        }
    }

    
}