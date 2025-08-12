<?php

namespace App\Interfaces\Http\Controllers\Auth;

use App\Interfaces\Http\Controllers\Controller;
use App\Core\Application\UseCase\AuthUsecase;
use App\Core\Domain\DTO\DataResult;
use App\Interfaces\Http\Requests\ForgotPassRequest;
use App\Interfaces\Http\Requests\ResetPassRequest;
use Exception;

class ForgotPassController extends Controller{
    private AuthUsecase $authUsecase;

    public function __construct(AuthUsecase $authUsecase)
    {
        $this->authUsecase = $authUsecase;
    }

    public function forgotPassword(ForgotPassRequest $request)
    {
        try {
            // Lấy dữ liệu từ request đã được validate
            $data = $request->validated();

            $user = $this->authUsecase->forgotPassword($data['email']);
            $result = new DataResult(
                'Chúng tôi đã gửi mã OTP. Vui lòng kiểm tra email để nhận OTP.',
                200,
                $user
            );

            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ));
        }
    }

    public function ResetPassword(ResetPassRequest $request){
        try {
            $data = $request->validated();

            $result = $this->authUsecase->ResetPassword($data['email'],$data['password']);

            return response()->json(new DataResult(
                'Đổi mật khẩu thành công',
                200,
                ['success' => $result]
            ));

        } catch (Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ), 400);
        }
    }
}