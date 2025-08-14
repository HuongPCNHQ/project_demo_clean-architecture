<?php

namespace App\Core\Domain\Repositories;
use App\Core\Domain\Entities\UserEntity;
use Illuminate\Support\Collection;
use App\Infrastructure\Persistence\Models\User;

interface UserRepositoryInterface {

    public function findById(int $id): ?UserEntity;
    public function findByEmail(string $email): ?UserEntity;
    public function save(UserEntity $user): UserEntity;
    public function updateInfor(int $id, array $data): ?UserEntity;
    public function updatePassword(string $email, string $hashedPassword): bool;
    public function changePassword(int $userId, string $hashedPassword): bool;
    public function getAll(): Collection;
    public function getByRole(string $role): Collection;
    public function getByIsActive(int $isActive): Collection;
    public function getByIsLock(int $isLock): Collection;
    public function lockAndUnlock(int $id): ?UserEntity;
    public function removeUser(int $id): bool;

    // 2FA methods
    public function enableTwoFA(int $userId, string $secret): bool;
    public function disableTwoFA(int $userId): bool;
    public function verifyTwoFAOtpById(int $userId, string $otp): bool;

    // OTP methods
    public function updateOtpCode(int $userId, string $otp, \DateTime $expiresAt): bool;
    public function clearOtpCode(int $userId): bool;
    public function activateUser(int $userId, \DateTimeInterface $activatedAt): bool;

}