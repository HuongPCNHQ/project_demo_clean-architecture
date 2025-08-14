<?php

namespace App\Interfaces\Http\Controllers\Frontend;

use App\Core\Application\UseCase\Frontend\UserUsecase;
use App\Interfaces\Http\Controllers\Controller;
use App\Core\Domain\DTO\DataResult;
use App\Interfaces\Http\Requests\Frontend\UpdateInforRequest;

class UpdateInforController extends Controller{
    private UserUsecase $userUsecase;
    private UpdateInforRequest $updateInforRequest;

    public function __construct(UserUsecase $userUsecase, UpdateInforRequest $updateInforRequest)
    {
        $this->userUsecase = $userUsecase;
        $this->updateInforRequest = $updateInforRequest;

    }

    public function updateInfor(UpdateInforRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $user = $this->userUsecase->updateInfor($id, $data);

            return response()->json(new DataResult(
                "Cập nhật thành công",
                200, 
                $user
            ));
        } catch (\Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(), 
                400
            ), 400);
        }

    }
}