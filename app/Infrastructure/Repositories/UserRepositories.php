<?php

namespace App\Infrastructure\Repositories;

use App\Core\Domain\Repositories\UserRepositoryInterface;
use App\Core\Domain\Entities\UserEntity;
use App\Infrastructure\Persistence\Models\User;
use Carbon\Carbon;

class UserRepositories implements UserRepositoryInterface {
    public function findById(int $id): ?UserEntity
    {
        $model = User::find($id);
        return $model ? new UserEntity($model->toArray()) : null;
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $model = User::where('email', $email)->first();
        return $model ? new UserEntity($model->toArray()) : null;
    }

    public function save(UserEntity $user): UserEntity
    {
        $model = isset($user->id) ? User::find($user->id) : new User();

        $model->fill([
            'name'=> $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
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

    public function activateUser(int $userId): bool
    {
        return User::where('id', $userId)->update([
            'is_active' => 1,
            'otp_code' => null,
            'otp_expires_at' => null
        ]) > 0;
    }
}