<?php

namespace App\Interfaces\Http\Controllers\Auth;

use App\Interfaces\Http\Controllers\Controller;
use App\Core\Application\UseCase\AuthUsecase;
use App\Interfaces\Http\Requests\ActiveRequest;
use App\Core\Domain\DTO\DataResult;
use Exception;

class ActiviteController extends Controller
{
    private AuthUsecase $authUsecase;

    public function __construct(AuthUsecase $authUsecase)
    {
        $this->authUsecase = $authUsecase;
    }

    public function active(ActiveRequest $request)
    {

        try {
            $data = $request->validated();

            // Gọi use case để kích hoạt
            $success = $this->authUsecase->active($data['email'],$data['otp_code']);

            if ($success) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Kích hoạt tài khoản thành công!'
                ], 200);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Không thể kích hoạt tài khoản'
            ], 400);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}