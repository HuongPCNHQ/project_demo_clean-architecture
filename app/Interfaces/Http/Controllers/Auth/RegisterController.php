<?php

namespace App\Interfaces\Http\Controllers\Auth;

use App\Interfaces\Http\Controllers\Controller;
use App\Core\Application\UseCase\AuthUsecase;
use App\Interfaces\Http\Requests\RegisterRequest;
use App\Core\Domain\DTO\DataResult;

class RegisterController extends Controller{
    private AuthUsecase $authUsecase;

    public function __construct(AuthUsecase $authUsecase)
    {
        $this->authUsecase = $authUsecase;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authUsecase->register($request->validated());

        $result = new DataResult(
            'Đăng ký thành công. Vui lòng kiểm tra email để nhận OTP.',
            201,
            $user
        );
        return response()->json($result);

    }

    
}