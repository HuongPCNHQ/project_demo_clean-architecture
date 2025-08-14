<?php

namespace App\Interfaces\Http\Controllers\Frontend;

use App\Core\Application\UseCase\Frontend\UserUsecase;
use App\Interfaces\Http\Controllers\Controller;
use App\Core\Domain\DTO\DataResult;

class ShowInforController extends Controller{
    private UserUsecase $userUsecase;

    public function __construct(UserUsecase $userUsecase)
    {
        $this->userUsecase = $userUsecase;
    }

    public function showInfor(int $id)
    {
        try {

            $userInfo = $this->userUsecase->showInfor($id);

            return response()->json(new DataResult(
                'Lấy thông tin người dùng thành công',
                200,
                $userInfo
            ));

        } catch (\Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ));
        }

    }
}