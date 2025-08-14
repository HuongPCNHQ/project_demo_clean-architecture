<?php

namespace App\Interfaces\Http\Controllers\Frontend;

use App\Core\Application\UseCase\Frontend\UserUsecase;
use App\Interfaces\Http\Controllers\Controller;
use App\Core\Domain\DTO\DataResult;
use App\Interfaces\Http\Requests\Frontend\ChangePassRequest;

class ChangePasswordController extends Controller{
    private UserUsecase $userUsecase;
    private ChangePassRequest $changePassRequest;

    public function __construct(UserUsecase $userUsecase, ChangePassRequest $changePassRequest)
    {
        $this->userUsecase = $userUsecase;
        $this->changePassRequest = $changePassRequest;
    }

    public function changePassword(ChangePassRequest $request, int $id)
    {
        try {
            $this->userUsecase->changePassword(
                $id,
                $request->current_password,
                $request->new_password
            );

            return response()->json(new DataResult(
                "Đổi mật khẩu thành công",
                200
            ));
        } catch (\Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ),400);
        }
    }
}