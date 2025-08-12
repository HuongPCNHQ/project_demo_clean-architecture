<?php

namespace App\Interfaces\Http\Controllers\Auth;

use App\Interfaces\Http\Controllers\Controller;
use App\Core\Application\UseCase\AuthUsecase;
use App\Interfaces\Http\Requests\LoginRequest;
use App\Core\Domain\DTO\DataResult;
use Exception;

class LoginController extends Controller{
    private AuthUsecase $authUsecase;

    public function __construct(AuthUsecase $authUsecase)
    {
        $this->authUsecase = $authUsecase;
    }

    public function login(LoginRequest $request)
    {
        try {
            // Lấy dữ liệu từ request đã được validate
            $data = $request->validated();

            $user = $this->authUsecase->login($data['email'], $data['password']);
            $result = new DataResult(
                'Đăng nhập thành công',
                200,
                $user
            );

            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ),400);
        }

    }
}