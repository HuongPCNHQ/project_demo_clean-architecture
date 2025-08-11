<?php

namespace App\Core\Domain\Repositories;
use App\Core\Domain\Entities\UserEntity;

interface UserRepositoryInterface {

    public function findById(int $id): ?UserEntity;
    public function findByEmail(string $email): ?UserEntity;
    public function save(UserEntity $user): UserEntity;

    // 2FA methods
    public function enableTwoFA(int $userId, string $secret): bool;
    public function disableTwoFA(int $userId): bool;

    // OTP methods
    public function updateOtpCode(int $userId, string $otp, \DateTime $expiresAt): bool;
    public function clearOtpCode(int $userId): bool;
    public function activateUser(int $userId): bool;
}