<?php

namespace App\Interfaces\Http\Controllers\Auth;

use App\Core\Application\UseCase\Auth\TwoFactorUsecase;
use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    private TwoFactorUsecase $twoFactorUsecase;

    public function __construct(TwoFactorUsecase $twoFactorUsecase)
    {
        $this->twoFactorUsecase = $twoFactorUsecase;
    }

    /**
     * Bật 2FA: tạo secret + QR code
     */
    public function enable(Request $request)
    {
        $userId = $request->user()->id;
        $result = $this->twoFactorUsecase->enable($userId);

        return response()->json($result);
    }

    /**
     * Tắt 2FA
     */
    public function disable(Request $request)
    {
        $userId = $request->user()->id;
        $this->twoFactorUsecase->disable($userId);

        return response()->json([
            'message' => 'Tắt 2FA thành công',
        ]);
    }

    /**
     * Xác minh OTP khi đăng nhập
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $userId = $request->user()->id;
        $otp = $request->otp;

        $isValid = $this->twoFactorUsecase->verifyOtp($userId, $otp);

        if (!$isValid) {
            return response()->json([
                'status' => false,
                'message' => 'Mã OTP không hợp lệ'
            ], 422);
        }

        return response()->json([
            'status' => true,
            'message' => 'Xác thực 2FA thành công',
            'redirect_url' => route('dashboard')
        ]);
    }
}
