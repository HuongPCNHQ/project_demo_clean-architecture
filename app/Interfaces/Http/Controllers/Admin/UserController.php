<?php

namespace App\Interfaces\Http\Controllers\Admin;

use App\Core\Application\UseCase\Admin\UserUsecase;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Admin\AddUserRequest;
use App\Core\Domain\DTO\DataResult;
use App\Interfaces\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    private AddUserRequest $addUserRequest;
    private UserUsecase $userUsecase;

    public function __construct(UserUsecase $userUsecase)
    {
        $this->userUsecase = $userUsecase;
    }

    public function getUserById(int $id){
        try {
            $user = $this->userUsecase->getUserById($id);
            $result = new DataResult(
                'Lấy thông tin tài khoản thành công.',
                201,
                $user
            );
            return response()->json($result);
        } catch (\Exception $e) {
            $result = new DataResult(
                $e->getMessage(),
                400,
                null
            );
        }
    }

    public function addUser(AddUserRequest $request){
        try {
            $user = $this->userUsecase->addUser($request->validated());

            $result = new DataResult(
                'Tạo tài khoản mới thành công.',
                201,
                $user
            );

            return response()->json($result);
            
        } catch (\Exception $e) {
            $result = new DataResult(
                $e->getMessage(),
                400,
                null
            );

            return response()->json($result);
        }
    }

    public function updateUser(UpdateUserRequest $request, int $id){
        try {
            $data = $request->validated();
            $user = $this->userUsecase->updateUser($id, $data);

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

    public function lockAndUnlock(int $id){
        try {
            $user = $this->userUsecase->lockAndUnlock($id);

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

    public function removeUser(int $id){
        try {
            $user = $this->userUsecase->removeUser($id);

            return response()->json(new DataResult(
                "Xoá tài khoản thành công",
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

    public function listUser(){
        try{
            $user = $this->userUsecase->listUser();
            $result = new DataResult(
                'Lấy danh sách thành công.',
                200,
                $user
            );
            return response()->json($result);
        }
        catch(\Exception $e){
            $result = new DataResult(
                $e->getMessage(),
                400,
                null
            );
            return response()->json($result);
        }
    }

    public function listUserByRole(string $role){
        try{
            $user = $this->userUsecase->listUserByRole($role);
            $result = new DataResult(
                'Lấy danh sách thành công.',
                200,
                $user
            );
            return response()->json($result);
        }
        catch(\Exception $e){
            $result = new DataResult(
                $e->getMessage(),
                400,
                null
            );
            return response()->json($result);
        }
    }

    public function listUserByIsActive(int $isActive){
        try{
            $user = $this->userUsecase->listUserByIsActive($isActive);
            $result = new DataResult(
                'Lấy danh sách thành công.',
                200,
                $user
            );
            return response()->json($result);
        }
        catch(\Exception $e){
            $result = new DataResult(
                $e->getMessage(),
                400,
                null
            );
            return response()->json($result);
        }
    }

    public function listUserByIsLock(int $isLock){
        try{
            $user = $this->userUsecase->listUserByIsLock($isLock);
            $result = new DataResult(
                'Lấy danh sách thành công.',
                200,
                $user
            );
            return response()->json($result);
        }
        catch(\Exception $e){
            $result = new DataResult(
                $e->getMessage(),
                400,
                null
            );
            return response()->json($result);
        }
    }
}