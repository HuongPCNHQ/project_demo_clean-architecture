<?php

namespace App\Infrastructure\Repositories;

use App\Core\Domain\Repositories\UserRepositoryInterface;
use App\Core\Domain\Entities\UserEntity;
use App\Infrastructure\Persistence\Models\User;
use Illuminate\Support\Collection;
use PragmaRX\Google2FA\Google2FA;

class UserRepositories implements UserRepositoryInterface {
    public function findById(int $id): ?UserEntity
    {
        $model = User::find($id);
        return $model ? new UserEntity($model->getAttributes()) : null;
    }

    public function findByEmail(string $email): ?UserEntity
    {   
        $model = User::where('email', $email)->first();
        return $model ? new UserEntity($model->getAttributes()) : null;
    }

    public function getAll(): Collection
    {
        return User::all();
    }

    public function getByRole(string $role): Collection
    {
        return User::where('role', $role)->get();
    }

    public function getByIsActive(int $isActive): Collection
    {
        return User::where('is_active', $isActive)->get();
    }

    public function getByIsLock(int $isLock): Collection
    {
        return User::where('is_lock', $isLock)->get();
    }

    public function save(UserEntity $user): UserEntity
    {
        $model = isset($user->id) ? User::find($user->id) : new User();

        $model->fill([
            'name'=> $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'role' => $user->role,
            'email_verified_at'=> $user->email_verified_at,
            'password' => $user->password,
            'remember_token' => $user->remember_token,
            'is_active' => $user->is_active ?? 0,
            'two_fa_enabled' => $user->two_fa_enabled,
            'two_fa_secret' => $user->two_fa_secret,
            'otp_code' => $user->otp_code,
            'otp_expires_at' => $user->otp_expires_at,
        ]);

        $model->save();

        return new UserEntity($model->toArray());
    }


    public function updateInfor(int $id, array $data): ?UserEntity
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        $user->update($data);

        return new UserEntity($user->toArray());
    }

    public function lockAndUnlock(int $id): ?UserEntity
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        $user->is_lock = $user->is_lock ? 0 : 1;
        $user->save();

        return new UserEntity($user->toArray());
    }

    public function removeUser(int $id): bool
    {
        $model = User::find($id);
        if (!$model) {
            return false;
        }

        return $model->delete();
    }

    public function enableTwoFA(int $userId, string $secret): bool
    {
        return User::where('id', $userId)->update([
            'two_fa_enabled' => true,
            'two_fa_secret'  => $secret
        ]) > 0;
    }

    public function disableTwoFA(int $userId): bool
    {
        return User::where('id', $userId)->update([
            'two_fa_enabled' => false,
            'two_fa_secret'  => null
        ]) > 0;
    }

    public function verifyTwoFAOtpById(int $userId, string $otp): bool
    {
        $user = User::find($userId); // Eloquent model
        if (!$user || !$user->two_fa_enabled) {
            return false;
        }

        $google2fa = new Google2FA();
        return $google2fa->verifyKey($user->two_fa_secret, $otp);
    }


    public function updateOtpCode(int $userId, string $otp, \DateTime $expiresAt): bool
    {
        return User::where('id', $userId)->update([
            'otp_code'       => $otp,
            'otp_expires_at' => $expiresAt->format('Y-m-d H:i:s')
        ]) > 0;
    }

    public function clearOtpCode(int $userId): bool
    {
        return User::where('id', $userId)->update([
            'otp_code'       => null,
            'otp_expires_at' => null
        ]) > 0;
    }

    public function activateUser(int $userId, \DateTimeInterface $activatedAt): bool
    {
        return User::where('id', $userId)->update([
            'is_active' => 1,
            'email_verified_at'  => $activatedAt->format('Y-m-d H:i:s'),
            'otp_code' => null,
            'otp_expires_at' => null
        ]) > 0;
    }

    public function updatePassword(string $email, string $hashedPassword): bool
    {
        return User::where('email', $email)->update([
            'password' => $hashedPassword
        ]) > 0;
    }

    //thay đổi mk trong trang home
    public function changePassword(int $userId, string $hashedPassword): bool
    {
        return User::where('id', $userId)->update([
            'password' => $hashedPassword
        ]) > 0;
    }
}