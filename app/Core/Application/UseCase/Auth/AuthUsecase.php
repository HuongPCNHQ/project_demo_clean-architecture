<?php 

namespace App\Core\Application\UseCase\Auth;

use App\Core\Application\Services\MailServiceInterface;
use App\Core\Domain\Contracts\UserContract;
use App\Core\Domain\Entities\UserEntity;
use App\Core\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthUsecase {
    private UserRepositoryInterface $userRepository;
    private MailServiceInterface $mailService;
    private UserContract $userContract;

    public function __construct(
        UserRepositoryInterface $userRepository,
        MailServiceInterface $mailService,
        UserContract $userContract
    ){
        $this->userRepository = $userRepository;
        $this->mailService = $mailService;
        $this->userContract = $userContract;
    }

    public function register(array $data) : UserEntity{
        $otp = random_int(100000, 999999);

        $user = new UserEntity([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => null,
            'two_fa_enabled' => true,
            'two_fa_secret' => null,
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        // Lưu user vào DB
        $savedUser = $this->userRepository->save($user);
        // Gửi OTP qua email
        $this->mailService->sendOtp($savedUser->email, $otp);

        return $savedUser;
    }

    public function active(string $email, string $otp): bool{
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new \Exception('Không tìm thấy người dùng');
        }

        if (
            $user->otp_code !== $otp ||
            !$user->otp_expires_at ||
            $user->otp_expires_at->isPast()
        ) {
            return false;
        }

        return $this->userRepository->activateUser($user->id,now());
    }

    public function login(string $email, string $password): array
    {
        $user = $this->userRepository->findByEmail($email);
        
        $this->userContract->validateLogin($user, $password);
        
        return [
            'user'  => $user,
        ];
    }

    public function forgotPassword(string $email): array
    {
        $otp = random_int(100000, 999999);
        $otp_expires_at = now()->addMinutes(5);
        $user = $this->userRepository->findByEmail($email);
        
        $this->userContract->validateForgot($user);

        $this->userRepository->updateOtpCode($user->id,$otp,$otp_expires_at);
        $this->mailService->sendOtp($user->email, $otp);
        return [
            'user'  => $user,
        ];
    }

    public function ResetPassword(string $email, string $newPassword): bool
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new Exception("Người dùng không tồn tại");
        }
        $hashedPassword = Hash::make($newPassword);
        return $this->userRepository->updatePassword($email, $hashedPassword);
    }
}