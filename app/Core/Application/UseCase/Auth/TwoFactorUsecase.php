<?php

namespace App\Core\Application\UseCase\Auth;

use App\Core\Domain\Repositories\UserRepositoryInterface;
use PragmaRX\Google2FA\Google2FA;
use Exception;

class TwoFactorUsecase
{
    private UserRepositoryInterface $userRepository;
    protected $google2fa;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->google2fa = new Google2FA();
    }

    public function enable(int $userId): array
    {
        $secret = $this->google2fa->generateSecretKey();

        $this->userRepository->enableTwoFA($userId, $secret);

        return [
            'secret' => $secret,
            'qr_url' => $this->google2fa->getQRCodeUrl(
                config('app.name'),
                $this->userRepository->findById($userId)->email,
                $secret
            )
        ];
    }

    public function disable(int $userId): bool
    {
        return $this->userRepository->disableTwoFA($userId);
    }

    public function verifyOtp(int $userId, string $otp): bool
    {
        return $this->userRepository->verifyTwoFAOtpById($userId, $otp);
    }
}
